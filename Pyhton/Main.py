from BioskopLuxury import BioskopLuxury


def main():
    # deklarasi list untuk menyimpan banyak data berupa objek Bioskop
    # (di Python, list berperan seperti ArrayList di Java)
    daftarBioskop = []
    awal = BioskopLuxury(1, "XXI", "JL Kolmas", 7, "Bandung", "Lounge Bahari", 12, 1200000, "LA Beau", 5, 3)
    daftarBioskop.append(awal)
    awal = BioskopLuxury(2, "CGV", "JL SumurBor", 6, "Bandung", "Lounge Bihara", 8, 150000, "LA BauBau", 10, 15)
    daftarBioskop.append(awal)
    awal = BioskopLuxury(3, "Cinepolis", "JL Sumbang", 8, "Jakarta", "Lounge bambang", 2, 80000, "Mang Bahar", 20, 2)
    daftarBioskop.append(awal)
    awal = BioskopLuxury(4, "Reynema", "JL Cimareme", 10, "Bandung", "Lounge Sultan", 20, 200000, "LA LA LA", 20, 21)
    daftarBioskop.append(awal)
    awal = BioskopLuxury(5, "NoeNema", "JL Cantik", 17, "Bandung", "Lounge Beautiful", 17, 170307, "LA Pretty", 17, 17)
    daftarBioskop.append(awal)
    print("<<<<<<<<<<<< Menu utak atik data bioskop >>>>>>>>>>>>>\n")
    print("insert: Untuk tambah data baru")
    print("Show: Untuk menampilkan data yang ada")
    print("Exit: Untuk keluar dari program")
    print("Help: untuk melihat perintah pada program ini")
    print("Penggunaan huruf besar dan kecil tidak berpengaruh\n")
    # perulangan sampai user memasukan perintah exit atau Exit
    # huruf besar huruf kecil tidak berpengaruh disini
    while True:
        pilihan = input("Masukan perintah : ")

        # jika user memasukan insert sebagai perintah, perintah ini
        # adalah untuk user memasukan data ke dalam bungkusan daftarBioskop
        # user diminta memasukan id, nama, alamat dll
        if pilihan.lower() == "insert":
            id = 0
            # perulangan ini untuk mencegah user memasukan masukan selain angka untuk atribut id
            masukan = input("Masukan id: ")
            while True:
                try:
                    id = int(masukan)
                    break
                except ValueError:
                    masukan = input("Masukan hanya angka: ")

            # perulangan ini adalah untuk mengecek apakah atribut id dengan masukan dari user
            # sudah ada atau belum di dalam list
            for b in daftarBioskop:
                # kondisi jika masukan user sudah ada dalam list
                if b.getid() == id:
                    id_ada = b.getid()
                    # perulangan untuk user agar memasukan data yang benar
                    while id_ada == id:
                        masukan = input("Id sudah ada, masukan yang lain: ")
                        while True:
                            try:
                                id = int(masukan)
                                break
                            except ValueError:
                                masukan = input("Masukan hanya angka: ")

            nama = input("Masukan Nama: ")
            alamat = input("Masukan Alamat: ")

            # ini adalah perulangan yang sama dengan yang ada di id
            masukan = input("Masukan Jumlah Studio: ")
            while True:
                try:
                    jumlah_studio = int(masukan)
                    break
                except ValueError:
                    masukan = input("Masukan hanya angka: ")

            kota = input("Masukan Kota: ")
            nama_lounge = input("Masukan nama lounge: ")

            masukan = input("Masukan kapasitas lounge: ")
            while True:
                try:
                    kapasitas_lounge = int(masukan)
                    break
                except ValueError:
                    masukan = input("Masukan hanya angka: ")

            masukan = input("Masukan harga tiket premium: ")
            while True:
                try:
                    harga_tiket_premium = float(masukan)
                    break
                except ValueError:
                    masukan = input("Masukan hanya angka: ")

            nama_restoran = input("Masukan nama restoran: ")

            masukan = input("Masukan nama jumlah meja: ")
            while True:
                try:
                    jumlah_meja = int(masukan)
                    break
                except ValueError:
                    masukan = input("Masukan hanya angka: ")

            masukan = input("Masukan jumlah_reservasi: ")
            while True:
                try:
                    jumlah_reservasi = int(masukan)
                    break
                except ValueError:
                    masukan = input("Masukan hanya angka: ")

            # memasukan data yang dimasukan tadi ke dalam objek BioskopLuxury yang baru
            b = BioskopLuxury(id, nama, alamat, jumlah_studio, kota, nama_lounge, kapasitas_lounge,
                            harga_tiket_premium, nama_restoran, jumlah_meja, jumlah_reservasi)
            daftarBioskop.append(b)  # lalu memasukan bioskop baru yang tadi ke dalam list/bungkusan
            print("data berhasil dimasukan coyy uhuyyy geloo brutal")

        # perintah untuk menampilkan semua data yang tersedia di dalam bungkusan
        elif pilihan.lower() == "show":
            # jika bungkusan kosong
            if len(daftarBioskop) == 0:
                print("Kosong loh yahhh")
            else:
                # semua variabel untuk menyimpan data masing masing spasi agar tabel rapih
                spasi_nama = 0
                spasi_alamat = 0
                spasi_kota = 0
                spasi_id = 0
                spasi_jumlah = 0
                spasi_nama_lounge = 0
                spasi_kapasitas_lounge = 0
                spasi_harga_tiket_premium = 0
                spasi_nama_restoran = 0
                spasi_jumlah_meja = 0
                spasi_jumlah_reservasi = 0
                # melakukan for each atau perulangan sesuai jumlah data yang ada dalam
                # bungkusan daftarBioskop
                # perulangan ini bertujuan untuk mencari data paling panjang di masing masing
                # atribut
                for b in daftarBioskop:
                    spasi_nama = max(spasi_nama, len(b.getnama()) + 2, len("Nama"))
                    spasi_alamat = max(spasi_alamat, len(b.getalamat()) + 2, len("Alamat"))
                    spasi_kota = max(spasi_kota, len(b.getkota()) + 2, len("Kota"))
                    spasi_id = max(spasi_id, len(str(b.getid())) + 2, len("Id"))
                    spasi_jumlah = max(spasi_jumlah, len(str(b.getjumlah_studio())) + 2, len("Jumlah Studio"))
                    spasi_nama_lounge = max(spasi_nama_lounge, len(b.getnamalounge()) + 2, len("Nama Lounge"))
                    spasi_kapasitas_lounge = max(spasi_kapasitas_lounge, len(str(b.getkapasitaslounge())) + 2, len("Kapasitas Lounge"))
                    spasi_harga_tiket_premium = max(spasi_harga_tiket_premium, len(str(b.gethargatiketpremium())) + 2, len("Harga Tiket (Rp)"))
                    spasi_nama_restoran = max(spasi_nama_restoran, len(b.getnamarestoran()) + 2, len("Nama Restoran"))
                    spasi_jumlah_meja = max(spasi_jumlah_meja, len(str(b.getjumlahmeja())) + 2, len("Jumlah Meja"))
                    spasi_jumlah_reservasi = max(spasi_jumlah_reservasi, len(str(b.getjumlahreservasi())) + 2, len("Jumlah Reservasi (orang)"))

                lebar_tabel = (spasi_alamat + spasi_nama_lounge + spasi_nama_restoran + spasi_kota
                               + spasi_id + spasi_kapasitas_lounge + spasi_harga_tiket_premium
                               + spasi_jumlah_meja + spasi_jumlah_reservasi + spasi_nama + spasi_jumlah + 13)

                # mulai menampilkan data dengan tabel
                print("Daftar Bioskop yang tersedia: ")
                for i in range(lebar_tabel):
                    print("-", end="")
                print()

                print("|ID", end="")
                for i in range(spasi_id - len("ID")):
                    print(" ", end="")
                print("|Nama", end="")
                for i in range(spasi_nama - len("Nama")):
                    print(" ", end="")
                print("|Alamat", end="")
                for i in range(spasi_alamat - len("Alamat")):
                    print(" ", end="")
                print("|Jumlah Studio", end="")
                for i in range(spasi_jumlah - len("Jumlah Studio")):
                    print(" ", end="")
                print("|kota", end="")
                for i in range(spasi_kota - len("kota")):
                    print(" ", end="")
                print("|Nama Lounge", end="")
                for i in range(spasi_nama_lounge - len("Nama Lounge")):
                    print(" ", end="")
                print("|Kapasitas Lounge", end="")
                for i in range(spasi_kapasitas_lounge - len("Kapasitas Lounge")):
                    print(" ", end="")
                print("|Harga Tiket (Rp)", end="")
                for i in range(spasi_harga_tiket_premium - len("Harga Tiket (Rp)")):
                    print(" ", end="")
                print("|Nama Restoran", end="")
                for i in range(spasi_nama_restoran - len("Nama Restoran")):
                    print(" ", end="")
                print("|Jumlah Meja", end="")
                for i in range(spasi_jumlah_meja - len("Jumlah Meja")):
                    print(" ", end="")
                print("|Jumlah Reservasi (orang)", end="")
                for i in range(spasi_jumlah_reservasi - (len("Jumlah Reservasi (orang)") - 1)):
                    print(" ", end="")
                print("|")

                for i in range(lebar_tabel):
                    print("-", end="")
                print()

                for b in daftarBioskop:
                    print("|" + str(b.getid()), end="")
                    for i in range(spasi_id - len(str(b.getid()))):
                        print(" ", end="")
                    print("|" + b.getnama(), end="")
                    for i in range(spasi_nama - len(b.getnama())):
                        print(" ", end="")
                    print("|" + b.getalamat(), end="")
                    for i in range(spasi_alamat - len(b.getalamat())):
                        print(" ", end="")
                    print("|" + str(b.getjumlah_studio()), end="")
                    for i in range(spasi_jumlah - len(str(b.getjumlah_studio()))):
                        print(" ", end="")
                    print("|" + b.getkota(), end="")
                    for i in range(spasi_kota - len(b.getkota())):
                        print(" ", end="")
                    print("|" + b.getnamalounge(), end="")
                    for i in range(spasi_nama_lounge - len(b.getnamalounge())):
                        print(" ", end="")
                    print("|" + str(b.getkapasitaslounge()), end="")
                    for i in range(spasi_kapasitas_lounge - len(str(b.getkapasitaslounge()))):
                        print(" ", end="")
                    print("|" + str(b.gethargatiketpremium()), end="")
                    for i in range(spasi_harga_tiket_premium - len(str(b.gethargatiketpremium()))):
                        print(" ", end="")
                    print("|" + b.getnamarestoran(), end="")
                    for i in range((spasi_nama_restoran + 1) - len(b.getnamarestoran())):
                        print(" ", end="")
                    print("|" + str(b.getjumlahmeja()), end="")
                    for i in range(spasi_jumlah_meja - len(str(b.getjumlahmeja()))):
                        print(" ", end="")
                    print("|" + str(b.getjumlahreservasi()), end="")
                    for i in range(spasi_jumlah_reservasi - len(str(b.getjumlahreservasi()))):
                        print(" ", end="")
                    print("|")
                    for i in range(lebar_tabel):
                        print("-", end="")
                    print()
        # jika perintah nya tidak sesuai dengan perintah yang sudah disediakan tetapi
        # tidak dengan perintah exit, karena perintah exit adalah perintah untuk
        # mengakhiri program
        else:
            if pilihan.lower() != "exit":
                print("Perintah tidak dikenali... (nyawit ni)")

        if pilihan.lower() == "exit":
            break


if __name__ == "__main__":
    main()