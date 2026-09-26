<?php
// Class WAJIB sudah dikenal SEBELUM session_start(), supaya PHP bisa
// meng-unserialize object yang tersimpan di $_SESSION dari request sebelumnya.
// Urutan require harus dari parent ke child: Bioskop -> BioskopPremium -> BioskopLuxury.
require_once __DIR__ . '/Bioskop.php';
require_once __DIR__ . '/BioskopPremium.php';
require_once __DIR__ . '/BioskopLuxury.php';

session_start();

// 5 data awal, disamakan dengan 5 data awal di Main.java.
// Dibungkus fungsi supaya bisa dipanggil ulang saat reset, bukan cuma sekali di awal.
function dataAwalBioskop(): array {
    return [
        new BioskopLuxury(1, "XXI", "JL Kolmas", 7, "Bandung", "uploads/XXI.jpg", "Lounge Bahari", 12, 1200000, "LA Beau", 5, 3),
        new BioskopLuxury(2, "CGV", "JL SumurBor", 6, "Bandung", "uploads/CGV.jpg", "Lounge Bihara", 8, 150000, "LA BauBau", 10, 15),
        new BioskopLuxury(3, "Cinepolis", "JL Sumbang", 8, "Jakarta", "uploads/Cinepolis.jpg", "Lounge bambang", 2, 80000, "Mang Bahar", 20, 2),
        new BioskopLuxury(4, "Reynema", "JL Cimareme", 10, "Bandung", "uploads/Reynema.jpg", "Lounge Sultan", 20, 200000, "LA LA LA", 20, 21),
        new BioskopLuxury(5, "NoeNema", "JL Cantik", 17, "Bandung", "uploads/NoeNema.jpg", "Lounge Beautiful", 17, 170307, "LA Pretty", 17, 17),
    ];
}

// Pakai empty(), bukan isset(): isset() tetap true walau isinya array kosong []
// (misal peninggalan session lama), sehingga 5 data awal tidak pernah terisi ulang.
if (empty($_SESSION['daftarBioskop'])) {
    $_SESSION['daftarBioskop'] = dataAwalBioskop();
}

// Jaga-jaga: kalau ada data lama di session yang formatnya BUKAN object BioskopLuxury
// (misal peninggalan versi kode sebelumnya), reset otomatis ke 5 data awal supaya
// tidak menyebabkan fatal error "Call to a member function ... on <tipe lain>"
$adaDataTidakValid = false;
foreach ($_SESSION['daftarBioskop'] as $item) {
    if (!($item instanceof BioskopLuxury)) {
        $adaDataTidakValid = true;
    }
}
if ($adaDataTidakValid) {
    $_SESSION['daftarBioskop'] = dataAwalBioskop();
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

// Mencari objek BioskopLuxury berdasarkan id dalam daftar.
function cariBioskopById(array $daftar, $id): ?BioskopLuxury {
    foreach ($daftar as $b) {
        if ($b->getid() === $id) {
            return $b;
        }
    }
    return null;
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
        $namaLounge = trim($_POST['nama_lounge'] ?? '');
        $kapasitasLounge = filter_var($_POST['kapasitas_lounge'] ?? '', FILTER_VALIDATE_INT);
        $hargaTiketPremium = filter_var($_POST['harga_tiket_premium'] ?? '', FILTER_VALIDATE_FLOAT);
        $namaRestoran = trim($_POST['nama_restoran'] ?? '');
        $jumlahMeja = filter_var($_POST['jumlah_meja'] ?? '', FILTER_VALIDATE_INT);
        $jumlahReservasi = filter_var($_POST['jumlah_reservasi'] ?? '', FILTER_VALIDATE_INT);

        if ($id === false) {
            $pesanError = 'Id harus berupa angka.';
        } elseif ($jumlahStudio === false) {
            $pesanError = 'Jumlah studio harus berupa angka.';
        } elseif ($kapasitasLounge === false) {
            $pesanError = 'Kapasitas lounge harus berupa angka.';
        } elseif ($hargaTiketPremium === false) {
            $pesanError = 'Harga tiket premium harus berupa angka.';
        } elseif ($jumlahMeja === false) {
            $pesanError = 'Jumlah meja harus berupa angka.';
        } elseif ($jumlahReservasi === false) {
            $pesanError = 'Jumlah reservasi harus berupa angka.';
        } elseif ($nama === '' || $alamat === '' || $kota === '' || $namaLounge === '' || $namaRestoran === '') {
            $pesanError = 'Nama, alamat, kota, nama lounge, dan nama restoran wajib diisi.';
        } elseif (cariBioskopById($_SESSION['daftarBioskop'], $id) !== null) {
            $pesanError = 'Id sudah ada, gunakan id lain.';
        } else {
            $pathGambar = simpanGambar($_FILES['gambar'] ?? null, $direktoriUpload);
            if ($pathGambar === false) {
                $pesanError = 'Gambar harus berformat jpg, jpeg, png, gif, atau webp.';
            } else {
                $bioskopBaru = new BioskopLuxury(
                    $id, $nama, $alamat, $jumlahStudio, $kota, $pathGambar,
                    $namaLounge, $kapasitasLounge, $hargaTiketPremium,
                    $namaRestoran, $jumlahMeja, $jumlahReservasi
                );
                $_SESSION['daftarBioskop'][] = $bioskopBaru;
                $pesan = 'data berhasil dimasukan coyy uhuyyy geloo brutal';
            }
        }
    }

    // ================= RESET SESSION =================
    elseif ($aksi === 'reset') {
        // hapus file gambar fisik di folder uploads/ HANYA untuk gambar hasil upload user
        // (dibuat oleh simpanGambar(), nama filenya selalu diawali "bioskop_").
        // Gambar 5 data awal (uploads/XXI.jpg, dst.) sengaja tidak dihapus karena bukan
        // hasil upload, jadi tidak boleh ikut terhapus saat reset.
        foreach ($_SESSION['daftarBioskop'] as $b) {
            $gambarLama = $b->getgambar();
            $namaFileGambar = $gambarLama !== null ? basename($gambarLama) : null;
            $adalahHasilUpload = $namaFileGambar !== null && str_starts_with($namaFileGambar, 'bioskop_');
            if ($adalahHasilUpload && file_exists(__DIR__ . '/' . $gambarLama)) {
                unlink(__DIR__ . '/' . $gambarLama);
            }
        }
        $_SESSION['daftarBioskop'] = dataAwalBioskop();
        $pesan = 'Semua data berhasil direset ke 5 data awal.';
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
        max-width: 1300px;
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
    button.danger{
        background: var(--danger);
        color: #fff0e9;
    }

    .table-scroll{
        overflow-x: auto;
    }
    table{
        width: 100%;
        border-collapse: collapse;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        font-size: 0.85rem;
        white-space: nowrap;
    }
    thead th{
        text-align: left;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-size: 0.68rem;
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
        font-size: 0.6rem;
        color: var(--text-dim);
        text-align: center;
        white-space: normal;
    }
    .kosong{
        color: var(--text-dim);
        font-family: 'Helvetica Neue', Arial, sans-serif;
        font-size: 0.9rem;
        padding: 24px 0;
    }
</style>
</head>
<body>
<div class="wrap">

    <header>
        <h1>Layar Tayang</h1>
        <p>Pencatatan data bioskop luxury — disimpan sementara di session, bukan database.</p>
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
                    <label for="nama_lounge">Nama Lounge</label>
                    <input type="text" id="nama_lounge" name="nama_lounge" required>
                </div>
                <div>
                    <label for="kapasitas_lounge">Kapasitas Lounge</label>
                    <input type="number" id="kapasitas_lounge" name="kapasitas_lounge" required>
                </div>
                <div>
                    <label for="harga_tiket_premium">Harga Tiket Premium (Rp)</label>
                    <input type="number" id="harga_tiket_premium" name="harga_tiket_premium" step="any" required>
                </div>
                <div>
                    <label for="nama_restoran">Nama Restoran</label>
                    <input type="text" id="nama_restoran" name="nama_restoran" required>
                </div>
                <div>
                    <label for="jumlah_meja">Jumlah Meja</label>
                    <input type="number" id="jumlah_meja" name="jumlah_meja" required>
                </div>
                <div>
                    <label for="jumlah_reservasi">Jumlah Reservasi (orang)</label>
                    <input type="number" id="jumlah_reservasi" name="jumlah_reservasi" required>
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
        <h2>Daftar Bioskop</h2>

        <?php if (empty($_SESSION['daftarBioskop'])): ?>
            <p class="kosong">Kosong loh yahhh</p>
        <?php else: ?>
            <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jumlah Studio</th>
                        <th>Kota</th>
                        <th>Nama Lounge</th>
                        <th>Kapasitas Lounge</th>
                        <th>Harga Tiket (Rp)</th>
                        <th>Nama Restoran</th>
                        <th>Jumlah Meja</th>
                        <th>Jumlah Reservasi (orang)</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION['daftarBioskop'] as $b): ?>
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
                        <td><?= htmlspecialchars($b->getnamalounge()) ?></td>
                        <td><?= htmlspecialchars($b->getkapasitas()) ?></td>
                        <td><?= htmlspecialchars($b->gethargatiketpremium()) ?></td>
                        <td><?= htmlspecialchars($b->getnamarestoran()) ?></td>
                        <td><?= htmlspecialchars($b->getjumlahmeja()) ?></td>
                        <td><?= htmlspecialchars($b->getjumlahreservasi()) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        <?php endif; ?>
    </section>

</div>
</body>
</html>