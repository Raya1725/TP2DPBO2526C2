from Bioskop import Bioskop


def main():
    # deklarasi list untuk menyimpan banyak data berupa objek Bioskop
    # (di Python, list berperan seperti ArrayList di Java)
    daftarBioskop = []

    pilihan = ""
    print("<<<<<<<<<<<< Menu utak atik data bioskop >>>>>>>>>>>>>\n")
    print("insert: Untuk tambah data baru")
    print("Show: Untuk menampilkan data yang ada")
    print("Update: Untuk mengedit data yang ada")
    print("Delete: Untuk menghapus data")
    print("Search: untuk mencari data")
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
            # memasukan data yang dimasukan tadi ke dalam objek Bioskop yang baru
            b = Bioskop(id, nama, alamat, jumlah_studio, kota)
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
                # melakukan for each atau perulangan sesuai jumlah data yang ada dalam
                # bungkusan daftarBioskop
                # perulangan ini bertujuan untuk mencari data paling panjang di masing masing
                # atribut
                for b in daftarBioskop:
                    spasi_nama = max(spasi_nama, len(b.getnama()) + 2)
                    spasi_alamat = max(spasi_alamat, len(b.getalamat()) + 2)
                    spasi_kota = max(spasi_kota, len(b.getkota()) + 2)
                    spasi_id = max(spasi_id, len(str(b.getid())) + 2)
                    spasi_jumlah = max(spasi_jumlah, len(str(b.getjumlah_studio())) + 2)

                # mulai menampilkan data dengan tabel
                print("Daftar Bioskop yang tersedia: ")
                for i in range(spasi_alamat + spasi_kota + spasi_nama + 53):
                    print("_", end="")
                print()
                for b in daftarBioskop:
                    print("|Id: " + str(b.getid()), end="")
                    for i in range(spasi_id - len(str(b.getid()))):
                        print(" ", end="")
                    print("|Nama: " + b.getnama(), end="")
                    for i in range(spasi_nama - len(b.getnama())):
                        print(" ", end="")
                    print("|Alamat: " + b.getalamat(), end="")
                    for i in range(spasi_alamat - len(b.getalamat())):
                        print(" ", end="")
                    print("|Jumlah_studio: " + str(b.getjumlah_studio()), end="")
                    for i in range(spasi_id - len(str(b.getjumlah_studio()))):
                        print(" ", end="")
                    print("|Kota: " + b.getkota(), end="")
                    for i in range(spasi_kota - len(b.getkota())):
                        print(" ", end="")
                    print("|", end="")
                    print()
                    for i in range(spasi_alamat + spasi_kota + spasi_nama + 53):
                        print("-", end="")
                    print()

        # perintah user untuk mengedit data yang ada di dalam bungkusan
        # user diminta memasukan id dari data yang ingin di ubah
        elif pilihan.lower() == "update":
            masukan = input("Masukan id bioskop yang mau diubah: ")
            while True:
                try:
                    ubah = int(masukan)
                    break
                except ValueError:
                    masukan = input("Masukan hanya angka: ")

            ketemu = False
            # perulangan sampai data nya ketemu
            for b in daftarBioskop:
                if ketemu:
                    break
                # jika data nya ketemu
                if b.getid() == ubah:
                    ketemu = True
                    # user diminta memasukan dengan memilih angka dari masing masing
                    # data yang ingin di ubah, contoh nya jika user memilih nomor 1, maka nama yang diubah
                    print("Apa yang mau diubah?")
                    print("1,Nama")
                    print("2,Alamat")
                    print("3,Jumlah Studio")
                    print("4,Kota")
                    print("5,Semua (kecuali id)")
                    masukan = input("Masukan nomor: ")
                    while True:
                        try:
                            update_yang_mana = int(masukan)
                            break
                        except ValueError:
                            masukan = input("Masukan hanya angka: ")

                    # perkondisian masing masing pilihan user (1 sampai 5)
                    if update_yang_mana == 1:
                        nama = input("Masukan nama: ")
                        b.setnama(nama)
                        print("Pergantian nama berhasil...")
                    elif update_yang_mana == 2:
                        alamat = input("Masukan alamat: ")
                        b.setalamat(alamat)
                        print("Pergantian alamat berhasil...")
                    elif update_yang_mana == 3:
                        masukan = input("Masukan jumlah studio: ")
                        while True:
                            try:
                                jumlah = int(masukan)
                                break
                            except ValueError:
                                masukan = input("Masukan hanya angka: ")
                        b.setjumlah_studio(jumlah)
                        print("Pergantian jumlah studio berhasil...")
                    elif update_yang_mana == 4:
                        kota = input("Masukan kota: ")
                        b.setkota(kota)
                        print("Pergantian kota berhasil...")
                    elif update_yang_mana == 5:
                        nama = input("Masukan nama: ")
                        b.setnama(nama)
                        alamat = input("Masukan alamat: ")
                        b.setalamat(alamat)
                        masukan = input("Masukan jumlah studio: ")
                        while True:
                            try:
                                jumlah = int(masukan)
                                break
                            except ValueError:
                                masukan = input("Masukan hanya angka: ")
                        b.setjumlah_studio(jumlah)
                        kota = input("Masukan kota: ")
                        b.setkota(kota)
                        print("Pergantian seluruh data berhasil...")
                    else:
                        print("Nomor tidak valid")

            # jika data tidak ditemukan
            if not ketemu:
                print("Kode tidak ditemukan.....")

        # perintah ini adalah perintah ketika user nya lupa apa saja yang bisa
        # dilakukan di program ini, cukup ketik help saja dan akan keluar peuntujuk nya
        elif pilihan.lower() == "help":
            print("<<<<<<<<<<<< Menu utak atik data bioskop >>>>>>>>>>>>>")
            print(" ")
            print("insert: Untuk tambah data baru")
            print("Show: Untuk menampilkan data yang ada")
            print("Update: Untuk mengedit data yang ada")
            print("Delete: Untuk menghapus data")
            print("Search: untuk mencari data")
            print("Exit: Untuk keluar dari program")
            print("Help: jika lupa apa saja perintah yang ada")

        # perintah ini adalah perintah untuk menghapus data dalam list,
        # user diminta memasukan data berupa id dan algoritma akan mencocokan
        # data nya ke dalam bungkusan, dan jika data nya ada, maka data akan terhapus
        # data yang terhapus adalah semua nya termasuk nama, alamat, jadi berhati hatilah
        elif pilihan.lower() == "delete":
            masukan = input("Masukan id bioskop yang mau dihapus: ")
            while True:
                try:
                    hapus = int(masukan)
                    break
                except ValueError:
                    masukan = input("Masukan hanya angka: ")

            ketemu = False
            i = 0
            while not ketemu and i < len(daftarBioskop):
                b = daftarBioskop[i]
                if b.getid() == hapus:
                    del daftarBioskop[i]
                    print("Data Berhasil terhapus.... noooooooo")
                    ketemu = True
                else:
                    i += 1
            if not ketemu:
                print("Data tidak ditemukan (jangan halu)......")

        # perintah ini adalah perintah untuk melakukan pencarian data spesifik
        # user diminta memasukan data berupa id dan jika id tersebut ada dalam bungkusan
        # atau list, maka data itu akan muncul dan hanya data itu saja
        elif pilihan.lower() == "search":
            masukan = input("Masukan id bioskop yang mau dicari: ")
            while True:
                try:
                    cari = int(masukan)
                    break
                except ValueError:
                    masukan = input("Masukan hanya angka: ")

            ketemu = False
            for b in daftarBioskop:
                if ketemu:
                    break
                if b.getid() == cari:
                    print("Id: " + str(b.getid()))
                    print("Nama: " + b.getnama())
                    print("Alamat: " + b.getalamat())
                    print("Jumlah_studio: " + str(b.getjumlah_studio()))
                    print("Kota: " + b.getkota())
                    ketemu = True
            if not ketemu:
                print("Data tidak ditemukan (jangan halu)......")

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