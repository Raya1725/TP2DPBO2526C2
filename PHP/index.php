<?php
// class Bioskop WAJIB sudah dikenal SEBELUM session_start(), supaya PHP bisa
// meng-unserialize object Bioskop yang tersimpan di $_SESSION dari request sebelumnya
require_once __DIR__ . '/Bioskop.php';

session_start();

if (!isset($_SESSION['daftarBioskop'])) {
    $_SESSION['daftarBioskop'] = [];
}

// Jaga-jaga: kalau ada data lama di session yang formatnya BUKAN object Bioskop
// (misal peninggalan versi kode sebelumnya yang masih pakai array), reset otomatis
// supaya tidak menyebabkan fatal error "Call to a member function ... on array"
foreach ($_SESSION['daftarBioskop'] as $item) {
    if (!($item instanceof Bioskop)) {
        $_SESSION['daftarBioskop'] = [];
        break;
    }
}

$direktoriUpload = __DIR__ . '/uploads/';
if (!is_dir($direktoriUpload)) {
    mkdir($direktoriUpload, 0755, true);
}

$pesan = '';
$pesanError = '';

// Fungsi kecil untuk memindahkan file gambar yang diupload ke folder uploads/
// dan mengembalikan path lokal (relatif) yang akan disimpan lewat setgambar()
function simpanGambar($fileInput, $direktoriUpload) {
    if (!isset($fileInput) || $fileInput['error'] !== UPLOAD_ERR_OK) {
        return null; // tidak ada file yang diupload / user tidak memilih gambar
    }
    $ekstensiDiizinkan = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $ekstensi = strtolower(pathinfo($fileInput['name'], PATHINFO_EXTENSION));
    if (!in_array($ekstensi, $ekstensiDiizinkan)) {
        return false; // ekstensi tidak valid
    }
    $namaFileBaru = uniqid('bioskop_', true) . '.' . $ekstensi;
    $tujuan = $direktoriUpload . $namaFileBaru;
    if (move_uploaded_file($fileInput['tmp_name'], $tujuan)) {
        return 'uploads/' . $namaFileBaru; // path lokal yang disimpan, BUKAN url
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'] ?? '';

    // ================= INSERT =================
    if ($aksi === 'insert') {
        $id = filter_var($_POST['id'] ?? '', FILTER_VALIDATE_INT);
        $nama = trim($_POST['nama'] ?? '');
        $alamat = trim($_POST['alamat'] ?? '');
        $jumlahStudio = filter_var($_POST['jumlah_studio'] ?? '', FILTER_VALIDATE_INT);
        $kota = trim($_POST['kota'] ?? '');

        if ($id === false) {
            $pesanError = 'Id harus berupa angka.';
        } elseif ($jumlahStudio === false) {
            $pesanError = 'Jumlah studio harus berupa angka.';
        } elseif ($nama === '' || $alamat === '' || $kota === '') {
            $pesanError = 'Nama, alamat, dan kota wajib diisi.';
        } else {
            // cek apakah id sudah dipakai bioskop lain
            $idSudahAda = false;
            foreach ($_SESSION['daftarBioskop'] as $b) {
                if ($b->getid() === $id) {
                    $idSudahAda = true;
                    break;
                }
            }
            if ($idSudahAda) {
                $pesanError = 'Id sudah ada, gunakan id lain.';
            } else {
                $pathGambar = simpanGambar($_FILES['gambar'] ?? null, $direktoriUpload);
                if ($pathGambar === false) {
                    $pesanError = 'Gambar harus berformat jpg, jpeg, png, gif, atau webp.';
                } else {
                    $bioskopBaru = new Bioskop($id, $nama, $alamat, $jumlahStudio, $kota, $pathGambar);
                    $_SESSION['daftarBioskop'][] = $bioskopBaru;
                    $pesan = 'Data berhasil dimasukan.';
                }
            }
        }
    }

    // ================= UPDATE =================
    elseif ($aksi === 'update') {
        $id = filter_var($_POST['id'] ?? '', FILTER_VALIDATE_INT);
        $ketemu = false;
        // objek PHP selalu dipegang lewat "handle", jadi memanggil setter pada $b
        // di dalam foreach ini otomatis mengubah objek asli di dalam $_SESSION
        foreach ($_SESSION['daftarBioskop'] as $b) {
            if ($b->getid() === $id) {
                $ketemu = true;
                $nama = trim($_POST['nama'] ?? '');
                $alamat = trim($_POST['alamat'] ?? '');
                $jumlahStudio = filter_var($_POST['jumlah_studio'] ?? '', FILTER_VALIDATE_INT);
                $kota = trim($_POST['kota'] ?? '');

                if ($jumlahStudio === false) {
                    $pesanError = 'Jumlah studio harus berupa angka.';
                    break;
                }
                if ($nama === '' || $alamat === '' || $kota === '') {
                    $pesanError = 'Nama, alamat, dan kota wajib diisi.';
                    break;
                }

                $pathGambarBaru = simpanGambar($_FILES['gambar'] ?? null, $direktoriUpload);
                if ($pathGambarBaru === false) {
                    $pesanError = 'Gambar harus berformat jpg, jpeg, png, gif, atau webp.';
                    break;
                }

                $b->setnama($nama);
                $b->setalamat($alamat);
                $b->setjumlah_studio($jumlahStudio);
                $b->setkota($kota);
                if ($pathGambarBaru !== null) {
                    $b->setgambar($pathGambarBaru); // ganti gambar hanya kalau user upload yang baru
                }
                $pesan = 'Data berhasil diubah.';
                break;
            }
        }
        if (!$ketemu && $pesanError === '') {
            $pesanError = 'Data dengan id tersebut tidak ditemukan.';
        }
    }

    // ================= RESET SESSION =================
    elseif ($aksi === 'reset') {
        // hapus juga semua file gambar fisik di folder uploads/ milik data yang direset
        foreach ($_SESSION['daftarBioskop'] as $b) {
            $gambarLama = $b->getgambar();
            if ($gambarLama !== null && file_exists(__DIR__ . '/' . $gambarLama)) {
                unlink(__DIR__ . '/' . $gambarLama);
            }
        }
        $_SESSION['daftarBioskop'] = [];
        $pesan = 'Semua data berhasil direset.';
    }

    // ================= DELETE =================
    elseif ($aksi === 'delete') {
        $id = filter_var($_POST['id'] ?? '', FILTER_VALIDATE_INT);
        $ketemu = false;
        foreach ($_SESSION['daftarBioskop'] as $index => $b) {
            if ($b->getid() === $id) {
                // hapus juga file gambar fisiknya dari folder uploads/, kalau ada
                $gambarLama = $b->getgambar();
                if ($gambarLama !== null && file_exists(__DIR__ . '/' . $gambarLama)) {
                    unlink(__DIR__ . '/' . $gambarLama);
                }
                unset($_SESSION['daftarBioskop'][$index]);
                $_SESSION['daftarBioskop'] = array_values($_SESSION['daftarBioskop']);
                $ketemu = true;
                $pesan = 'Data berhasil dihapus.';
                break;
            }
        }
        if (!$ketemu) {
            $pesanError = 'Data dengan id tersebut tidak ditemukan.';
        }
    }
}

// ================= SEARCH (lewat GET, tidak mengubah data) =================
$kataKunci = trim($_GET['cari'] ?? '');
$dataTampil = $_SESSION['daftarBioskop'];
if ($kataKunci !== '') {
    $dataTampil = array_values(array_filter($dataTampil, function (Bioskop $b) use ($kataKunci) {
        return (string)$b->getid() === $kataKunci
            || stripos($b->getnama(), $kataKunci) !== false
            || stripos($b->getkota(), $kataKunci) !== false;
    }));
}

// Data yang mau diedit (kalau user klik tombol Edit) diambil lewat ?edit=id di URL
$dataEdit = null;
if (isset($_GET['edit'])) {
    $idEdit = filter_var($_GET['edit'], FILTER_VALIDATE_INT);
    foreach ($_SESSION['daftarBioskop'] as $b) {
        if ($b->getid() === $idEdit) {
            $dataEdit = $b;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Layar Tayang — Data Bioskop</title>
<style>
    :root{
        --bg: #0f0d0b;
        --bg-panel: #17130f;
        --bg-panel-2: #1f1a15;
        --line: #362c22;
        --marquee: #d1a24a;
        --marquee-dim: #8a6c2f;
        --text: #f2ece1;
        --text-dim: #a89a86;
        --danger: #c1502e;
        --danger-bg: #2a150f;
        --ok: #6b8f5c;
        --ok-bg: #142010;
        --radius: 3px;
    }
    *{ box-sizing: border-box; }
    body{
        margin: 0;
        background: var(--bg);
        color: var(--text);
        font-family: 'Georgia', 'Times New Roman', serif;
        line-height: 1.5;
    }
    .wrap{
        max-width: 1100px;
        margin: 0 auto;
        padding: 40px 24px 80px;
    }
    header{
        border-bottom: 1px solid var(--line);
        padding-bottom: 28px;
        margin-bottom: 36px;
    }
    header h1{
        font-size: 2.4rem;
        margin: 0 0 6px;
        letter-spacing: 0.5px;
        color: var(--marquee);
        font-weight: 400;
    }
    header p{
        margin: 0;
        color: var(--text-dim);
        font-family: 'Helvetica Neue', Arial, sans-serif;
        font-size: 0.95rem;
    }
    .bulb-row{
        display: flex;
        gap: 6px;
        margin-top: 14px;
    }
    .bulb-row span{
        width: 6px; height: 6px; border-radius: 50%;
        background: var(--marquee-dim);
    }

    section{ margin-bottom: 48px; }
    h2{
        font-family: 'Helvetica Neue', Arial, sans-serif;
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--text-dim);
        margin: 0 0 16px;
    }

    .pesan{
        font-family: 'Helvetica Neue', Arial, sans-serif;
        padding: 12px 16px;
        border-radius: var(--radius);
        margin-bottom: 28px;
        font-size: 0.9rem;
    }
    .pesan.ok{ background: var(--ok-bg); color: var(--ok); border: 1px solid #2c4023; }
    .pesan.error{ background: var(--danger-bg); color: #e28a6c; border: 1px solid #4a2317; }

    form.panel{
        background: var(--bg-panel);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 24px;
    }
    .grid{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px 20px;
    }
    label{
        display: block;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        font-size: 0.78rem;
        color: var(--text-dim);
        margin-bottom: 6px;
    }
    input[type=text], input[type=number], input[type=file]{
        width: 100%;
        background: var(--bg-panel-2);
        border: 1px solid var(--line);
        color: var(--text);
        padding: 9px 10px;
        border-radius: var(--radius);
        font-family: 'Helvetica Neue', Arial, sans-serif;
        font-size: 0.95rem;
    }
    input:focus{ outline: 2px solid var(--marquee-dim); outline-offset: 1px; }
    .actions{
        margin-top: 20px;
        display: flex;
        gap: 10px;
        align-items: center;
    }
    button{
        font-family: 'Helvetica Neue', Arial, sans-serif;
        background: var(--marquee);
        color: #1a1410;
        border: none;
        padding: 10px 20px;
        border-radius: var(--radius);
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
    }
    button.secondary{
        background: transparent;
        color: var(--text-dim);
        border: 1px solid var(--line);
    }
    button.danger{
        background: var(--danger);
        color: #fff0e9;
    }
    a.link{
        color: var(--marquee);
        text-decoration: none;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        font-size: 0.85rem;
    }

    .search-row{
        display: flex;
        gap: 10px;
    }
    .search-row input{ flex: 1; }

    table{
        width: 100%;
        border-collapse: collapse;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        font-size: 0.9rem;
    }
    thead th{
        text-align: left;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-size: 0.72rem;
        color: var(--text-dim);
        border-bottom: 1px solid var(--line);
        padding: 10px 12px;
    }
    tbody td{
        padding: 12px;
        border-bottom: 1px solid var(--line);
        vertical-align: middle;
    }
    tbody tr:hover{ background: var(--bg-panel); }
    .thumb{
        width: 56px; height: 56px;
        object-fit: cover;
        border-radius: var(--radius);
        border: 1px solid var(--line);
        display: block;
    }
    .thumb-kosong{
        width: 56px; height: 56px;
        border-radius: var(--radius);
        border: 1px dashed var(--line);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.65rem;
        color: var(--text-dim);
        text-align: center;
    }
    .row-actions{ display: flex; gap: 8px; }
    .row-actions button, .row-actions a{ padding: 6px 12px; font-size: 0.78rem; }
    .kosong{
        color: var(--text-dim);
        font-family: 'Helvetica Neue', Arial, sans-serif;
        font-size: 0.9rem;
        padding: 24px 0;
    }

    .modal-bg{
        display: none;
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.6);
        align-items: center; justify-content: center;
        padding: 20px;
        z-index: 10;
    }
    .modal-bg.tampil{ display: flex; }
    .modal{
        background: var(--bg-panel);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 28px;
        max-width: 520px;
        width: 100%;
    }
    .modal h2{ margin-top: 0; }
</style>
</head>
<body>
<div class="wrap">

    <header>
        <h1>Layar Tayang</h1>
        <p>Pencatatan data bioskop — disimpan sementara di session, bukan database.</p>
        <div class="bulb-row">
            <span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span><span></span>
        </div>
        <form method="POST" onsubmit="return confirm('Yakin mau reset semua data? Ini tidak bisa dibatalkan.');" style="margin-top: 20px;">
            <input type="hidden" name="aksi" value="reset">
            <button type="submit" class="danger">Reset Semua Data</button>
        </form>
    </header>

    <?php if ($pesan): ?>
        <div class="pesan ok"><?= htmlspecialchars($pesan) ?></div>
    <?php endif; ?>
    <?php if ($pesanError): ?>
        <div class="pesan error"><?= htmlspecialchars($pesanError) ?></div>
    <?php endif; ?>

    <section>
        <h2>Tambah Data Baru</h2>
        <form class="panel" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="insert">
            <div class="grid">
                <div>
                    <label for="id">Id</label>
                    <input type="number" id="id" name="id" required>
                </div>
                <div>
                    <label for="nama">Nama Bioskop</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                <div>
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required>
                </div>
                <div>
                    <label for="jumlah_studio">Jumlah Studio</label>
                    <input type="number" id="jumlah_studio" name="jumlah_studio" required>
                </div>
                <div>
                    <label for="kota">Kota</label>
                    <input type="text" id="kota" name="kota" required>
                </div>
                <div>
                    <label for="gambar">Gambar (jpg, png, gif, webp)</label>
                    <input type="file" id="gambar" name="gambar" accept="image/*">
                </div>
            </div>
            <div class="actions">
                <button type="submit">Tambah Data</button>
            </div>
        </form>
    </section>

    <section>
        <h2>Cari Data</h2>
        <form class="panel search-row" method="GET">
            <input type="text" name="cari" placeholder="Cari berdasarkan id, nama, atau kota" value="<?= htmlspecialchars($kataKunci) ?>">
            <button type="submit" class="secondary">Cari</button>
            <?php if ($kataKunci !== ''): ?>
                <a class="link" href="index.php" style="align-self:center;">Reset</a>
            <?php endif; ?>
        </form>
    </section>

    <section>
        <h2>Daftar Bioskop <?= $kataKunci !== '' ? '— hasil pencarian "' . htmlspecialchars($kataKunci) . '"' : '' ?></h2>

        <?php if (empty($dataTampil)): ?>
            <p class="kosong">
                <?= empty($_SESSION['daftarBioskop']) ? 'Belum ada data. Tambahkan data baru di atas.' : 'Data tidak ditemukan.' ?>
            </p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jumlah Studio</th>
                        <th>Kota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($dataTampil as $b): ?>
                    <tr>
                        <td>
                            <?php if ($b->getgambar() !== null && file_exists(__DIR__ . '/' . $b->getgambar())): ?>
                                <img class="thumb" src="<?= htmlspecialchars($b->getgambar()) ?>" alt="Gambar <?= htmlspecialchars($b->getnama()) ?>">
                            <?php else: ?>
                                <div class="thumb-kosong">tidak ada gambar</div>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($b->getid()) ?></td>
                        <td><?= htmlspecialchars($b->getnama()) ?></td>
                        <td><?= htmlspecialchars($b->getalamat()) ?></td>
                        <td><?= htmlspecialchars($b->getjumlah_studio()) ?></td>
                        <td><?= htmlspecialchars($b->getkota()) ?></td>
                        <td class="row-actions">
                            <a href="?edit=<?= $b->getid() ?>"><button type="button" class="secondary">Edit</button></a>
                            <form method="POST" onsubmit="return confirm('Yakin hapus data ini?');" style="display:inline;">
                                <input type="hidden" name="aksi" value="delete">
                                <input type="hidden" name="id" value="<?= $b->getid() ?>">
                                <button type="submit" class="danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>

</div>

<?php if ($dataEdit): ?>
<div class="modal-bg tampil">
    <div class="modal">
        <h2>Ubah Data — Id <?= htmlspecialchars($dataEdit->getid()) ?></h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="update">
            <input type="hidden" name="id" value="<?= htmlspecialchars($dataEdit->getid()) ?>">
            <div class="grid">
                <div>
                    <label for="e_nama">Nama Bioskop</label>
                    <input type="text" id="e_nama" name="nama" value="<?= htmlspecialchars($dataEdit->getnama()) ?>" required>
                </div>
                <div>
                    <label for="e_alamat">Alamat</label>
                    <input type="text" id="e_alamat" name="alamat" value="<?= htmlspecialchars($dataEdit->getalamat()) ?>" required>
                </div>
                <div>
                    <label for="e_jumlah_studio">Jumlah Studio</label>
                    <input type="number" id="e_jumlah_studio" name="jumlah_studio" value="<?= htmlspecialchars($dataEdit->getjumlah_studio()) ?>" required>
                </div>
                <div>
                    <label for="e_kota">Kota</label>
                    <input type="text" id="e_kota" name="kota" value="<?= htmlspecialchars($dataEdit->getkota()) ?>" required>
                </div>
                <div>
                    <label for="e_gambar">Ganti Gambar (kosongkan jika tidak diubah)</label>
                    <input type="file" id="e_gambar" name="gambar" accept="image/*">
                </div>
            </div>
            <div class="actions">
                <button type="submit">Simpan Perubahan</button>
                <a class="link" href="index.php">Batal</a>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

</body>
</html>