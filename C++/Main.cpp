#include <iostream>
#include <vector>
#include <algorithm>
#include <string>
#include <limits>
#include "BioskopLuxury.cpp"
using namespace std;

int main(){

    ios::sync_with_stdio(0);
    //deklarasi vector baru dengan nama daftar bioskop untuk menyimpan data bioskop
    vector<BioskopLuxury> daftarbioskop;
    BioskopLuxury awal = BioskopLuxury(1, "XXI", "JL Kolmas", 7, "Bandung", "Lounge Bahari", 12, 120000, "LA Beau", 5, 3);
    daftarbioskop.push_back(awal);
    awal = BioskopLuxury(2, "CGV", "JL SumurBor", 6, "Bandung", "Lounge Bihara", 8, 150000, "LA Bau Bau", 10, 15);
    daftarbioskop.push_back(awal);
    awal = BioskopLuxury(3, "Cinepolis", "JL Sumbang", 8, "Jakarta", "Lounge Bambang", 2, 80000, "Mang Bahar", 20, 2);
    daftarbioskop.push_back(awal);
    awal = BioskopLuxury(4, "Reynema", "JL Cimareme", 10, "Bandung", "Lounge Sultan", 20, 200000, "LA LA LA", 20, 21);
    daftarbioskop.push_back(awal);
    awal = BioskopLuxury(5, "NoeNema", "JL Cantik", 17, "Bandung", "Lounge Beautiful", 17, 170307, "LA Pretty", 17, 17);
    daftarbioskop.push_back(awal);
    string pilihan;
    cout << "<<<<<<<<<<<< Menu utak atik data bioskop >>>>>>>>>>>>>" << endl;
    cout << endl;
    cout << "insert: Untuk tambah data baru" << endl;
    cout << "show: Untuk menampilkan data yang ada" << endl;
    cout << "Exit: Untuk keluar dari program" << endl;
    cout << "Help: untuk melihat perintah pada program ini" << endl;
    do{//perulangan do while atau meminta masukan dulu baru mengecek kondisi di akhir
        vector<BioskopLuxury>:: iterator iter = daftarbioskop.begin();//deklarasi iterator atau pengecek untuk vector daftarbioskop
        cout << "masukan perintah: ";
        cin >> pilihan;//meminta masukan user
        //jika user memilih menu insert atau memasukan data ke dalam vector
        if(pilihan == "insert" || pilihan == "Insert"){
            int id = 0;
            cout << "Masukan id: ";
            //user diminta memasukan data yang dibutuhkan seperti id, nama, alamat, jumlah studio dan kota
            cin >> id;
            /*
            untuk melakukan cek apakah masukan user berupa angka atau bukan
            jika bukan angka, maka user diminta memasukan lagi
            */ 
            while(cin.fail()){
                //reset status error cin atau masukan
                cin.clear();
                //buang sisa input untuk memasukan nya lagi
                cin.ignore(numeric_limits<streamsize>::max(), '\n');
                cout << "Masukan hanya angka: ";
                cin >> id;
            }
            cin.ignore();//buang karakter sisa untuk membersihkan masukan
            //perulangan untuk mengecek apakah id masukan user sudah ada atau belum
            while(iter != daftarbioskop.end()){
                Bioskop &B = *iter;
                //kondisi jika id masukan user sudah ada di vector
                if(B.getid() == id){
                    int id_ada = B.getid();
                    while(id_ada == id){
                        cout << "Id sudah ada, masukan yang lain: ";
                        cin >> id;
                        while(cin.fail()){
                            cin.clear();
                            cin.ignore(numeric_limits<streamsize>::max(), '\n');
                            cout << "Masukan hanya angka: ";
                            cin >> id;
                        }
                        cin.ignore();
                    }
                }
                else{
                    iter++;
                }
            }
            cout << "Masukan Nama: ";
            string nama;
            getline(cin, nama);
            cout << "Masukan Alamat: ";
            string alamat;
            getline(cin, alamat);
            cout << "Masukan Jumlah Studio: ";
            int jumlah_studio;
            cin >> jumlah_studio;
            while(cin.fail()){
                cin.clear();
                cin.ignore(numeric_limits<streamsize>::max(), '\n');
                cout << "Masukan hanya angka: ";
                cin >> jumlah_studio;
            }
            cin.ignore();
            cout << "Masukan Kota: ";
            string kota;
            getline(cin, kota);
            cout << "Masukan nama lounge: ";
            string nama_lounge;
            getline(cin, nama_lounge);
            cout << "Masukan kapasitas lounge: ";
            int kapasitas_lounge;
            cin >> kapasitas_lounge;
            while (cin.fail()) {
                cin.clear();
                cin.ignore(numeric_limits<streamsize>::max(), '\n');
                cout << "Masukan hanya angka: ";
                cin >> kapasitas_lounge;
            }
            cin.ignore();
            cout << "Masukan harga tiket premium: ";
            double harga_tiket_premium;
            cin >> harga_tiket_premium;
            while (cin.fail()) {
                cin.clear();
                cin.ignore(numeric_limits<streamsize>::max(), '\n');
                cout << "Masukan hanya angka: ";
                cin >> harga_tiket_premium;
            }
            cin.ignore();
            cout << "Masukan nama restoran: ";
            string nama_restoran;
            getline(cin, nama_restoran);
            cout << "Masukan nama jumlah meja: ";
            int jumlah_meja;
            cin >> jumlah_meja;
            while (cin.fail()) {
                cin.clear();
                cin.ignore(numeric_limits<streamsize>::max(), '\n');
                cout << "Masukan hanya angka: ";
                cin >> jumlah_meja;
            }
            cout << "Masukan jumlah_reservasi: ";
            int jumlah_reservasi;
            cin >> jumlah_reservasi;
            while (cin.fail()) {
                cin.clear();
                cin.ignore(numeric_limits<streamsize>::max(), '\n');
                cout << "Masukan hanya angka: ";
                cin >> jumlah_reservasi;
            }
            cin.ignore();
            // memasukan data yang dimasukan tadi ke dalam konstruk bioskop yang baru
            BioskopLuxury B(id, nama, alamat, jumlah_studio, kota, nama_lounge, kapasitas_lounge,
                            harga_tiket_premium, nama_restoran, jumlah_meja, jumlah_reservasi);
            daftarbioskop.push_back(B);
            cout << "data berhasil dimasukan coyy uhuyyy geloo brutal" << endl;
            //memasukan data dengan konstruk bioskopp baru lalu sekalian memasukan data kedalamnya
        }
        //salah satu opsi perintah, perintah inin adalah untuk menampikan semua data yang ada di vector
        else if(pilihan == "show" || pilihan == "Show"){
            if(daftarbioskop.empty()){//kondisi jika vector daftar bioskop kosong
                cout << "Kosong loh yahhh" << endl;
            }
            else{
                //ini adalah algoritma untuk menghitung spasi dari setiap data
                //berbagai variabel untuk menyimpan data masing masing spasi
                int spasi_nama = 0;
                int spasi_alamat = 0;
                int spasi_kota = 0;
                int spasi_id = 0;
                int spasi_jumlah = 0;
                int spasi_nama_lounge = 0;
                int spasi_kapasitas_lounge = 0;
                int spasi_harga_tiket_premium = 0;
                int spasi_nama_restoran = 0;
                int spasi_jumlah_meja = 0;
                int spasi_jumlah_reservasi = 0;
                //perulangan for untuk melakukan perhitungan masing masing spasi
                for (BioskopLuxury B : daftarbioskop) {
                    spasi_id     = max({spasi_id,     static_cast<int>(to_string(B.getid()).length() + 2),     static_cast<int>(string("Id").length())});
                    spasi_nama   = max({spasi_nama,   static_cast<int>(B.getnama().length() + 2),               static_cast<int>(string("Nama").length())});
                    spasi_alamat = max({spasi_alamat, static_cast<int>(B.getalamat().length() + 2),             static_cast<int>(string("Alamat").length())});
                    spasi_jumlah = max({spasi_jumlah, static_cast<int>(to_string(B.getjumlah_studio()).length() + 2), static_cast<int>(string("Jumlah Studio").length())});
                    spasi_kota   = max({spasi_kota,   static_cast<int>(B.getkota().length() + 2),               static_cast<int>(string("Kota").length())});
                    spasi_nama_lounge          = max({spasi_nama_lounge,          static_cast<int>(B.getnamalounge().length() + 2),          static_cast<int>(string("Nama Lounge").length())});
                    spasi_kapasitas_lounge     = max({spasi_kapasitas_lounge,     static_cast<int>(to_string(B.getkapasitaslounge()).length() + 2), static_cast<int>(string("Kapasitas Lounge").length())});
                    spasi_harga_tiket_premium  = max({spasi_harga_tiket_premium,  static_cast<int>(to_string(B.gethargatiket()).length() + 6), static_cast<int>(string("Harga Tiket").length())});
                    spasi_nama_restoran        = max({spasi_nama_restoran,        static_cast<int>(B.getnamarestoran().length() + 2),        static_cast<int>(string("Nama Restoran").length())});
                    spasi_jumlah_meja          = max({spasi_jumlah_meja,          static_cast<int>(to_string(B.getjumlahmeja()).length() + 2), static_cast<int>(string("Jumlah Meja").length())});
                    spasi_jumlah_reservasi     = max({spasi_jumlah_reservasi,     static_cast<int>(to_string(B.getjumlahreservasi()).length() + 2), static_cast<int>(string("Jumlah Reservasi (orang)").length())});
                }

                //mulai menampilkan data dengan tabel
                cout << "Daftar Bioskop yang tersedia: " << endl;
                for(int i = 0; i < spasi_alamat + spasi_nama_lounge + spasi_nama_restoran + spasi_kota + spasi_id + spasi_kapasitas_lounge + spasi_harga_tiket_premium + spasi_jumlah_meja + spasi_jumlah_reservasi + spasi_nama + spasi_jumlah + 7; i++){
                    cout << "-";
                }
                cout << endl;

                cout << "|ID";
                for(int i = 0; i < spasi_id - static_cast<int>(string("ID").length()); i++){
                    cout << " ";
                }
                cout << "|Nama";
                for(int i = 0; i < spasi_nama - static_cast<int>(string("Nama").length()); i++){
                    cout << " ";
                }
                cout << "|Alamat";
                for(int i = 0; i < spasi_alamat - static_cast<int>(string("Alamat").length()); i++){
                    cout << " ";
                }
                cout << "|Jumlah Studio";
                for(int i = 0; i < spasi_jumlah - static_cast<int>(string("Jumlah Studio").length()); i++){
                    cout << " ";
                }
                cout << "|kota";
                for(int i = 0; i < spasi_kota - static_cast<int>(string("kota").length()); i++){
                    cout << " ";
                }
                cout << "|Nama Lounge";
                for(int i = 0; i < spasi_nama_lounge - static_cast<int>(string("Nama_lounge").length()); i++){
                    cout << " ";
                }
                cout << "|Kapasitas Lounge";
                for(int i = 0; i < spasi_kapasitas_lounge - static_cast<int>(string("Kapasitas Lounge").length()); i++){
                    cout << " ";
                }
                cout << "|Harga Tiket";
                for(int i = 0; i < spasi_harga_tiket_premium - static_cast<int>(string("Harga Tiket").length() + 5); i++){
                    cout << " ";
                }
                cout << "|Nama Restoran";
                for(int i = 0; i < spasi_nama_restoran - static_cast<int>(string("Nama Restoran").length()); i++){
                    cout << " ";
                }
                cout << "|Jumlah Meja";
                for(int i = 0; i < spasi_jumlah_meja - static_cast<int>(string("Jumlah Meja").length()); i++){
                    cout << " ";
                }
                cout << "|Jumlah Reservasi (orang)";
                for(int i = 0; i < spasi_jumlah_reservasi - static_cast<int>(string("Jumlah Reservasi (orang)").length()); i++){
                    cout << " ";
                }
                cout << "|";
                cout << endl;

                for(int i = 0; i < spasi_alamat + spasi_nama_lounge + spasi_nama_restoran + spasi_kota + spasi_id + spasi_kapasitas_lounge + spasi_harga_tiket_premium + spasi_jumlah_meja + spasi_jumlah_reservasi + spasi_nama + spasi_jumlah + 7; i++){
                    cout << "-";
                }
                cout << endl;

                for(BioskopLuxury B : daftarbioskop){
                    cout << "|" << B.getid();
                    for(int i = 0; i < spasi_id - static_cast<int>(to_string(B.getid()).length()); i++){
                        cout << " ";
                    }
                    cout << "|" << B.getnama();
                    for(int i = 0; i < spasi_nama - static_cast<int>(B.getnama().length()); i++){
                        cout << " ";
                    }
                    cout << "|" << B.getalamat();
                    for(int i = 0; i < spasi_alamat - static_cast<int>(B.getalamat().length()); i++){
                        cout << " ";
                    }
                    cout << "|" << B.getjumlah_studio();
                    for(int i = 0; i < spasi_jumlah - static_cast<int>(to_string(B.getjumlah_studio()).length()); i++){
                        cout << " ";
                    }
                    cout << "|" << B.getkota();
                    for(int i = 0; i < spasi_kota - static_cast<int>(B.getkota().length()); i++){
                        cout << " ";
                    }
                    cout << "|" << B.getnamalounge();
                    for(int i = 0; i < spasi_nama_lounge - static_cast<int>(B.getnamalounge().length()); i++){
                        cout << " ";
                    }
                    cout << "|" << B.getkapasitaslounge();
                    for(int i = 0; i < spasi_kapasitas_lounge - static_cast<int>(to_string(B.getkapasitaslounge()).length()); i++){
                        cout << " ";
                    }
                    cout << "|" << B.gethargatiket();
                    for(int i = 0; i < (spasi_harga_tiket_premium + 2) - static_cast<int>(to_string(B.gethargatiket()).length()); i++){
                        cout << " ";
                    }
                    cout << "|" << B.getnamarestoran();
                    for(int i = 0; i < spasi_nama_restoran - static_cast<int>(B.getnamarestoran().length()); i++){
                        cout << " ";
                    }
                    cout << "|" << B.getjumlahmeja();
                    for(int i = 0; i < spasi_jumlah_meja - static_cast<int>(to_string(B.getjumlahmeja()).length()); i++){
                        cout << " ";
                    }
                    cout << "|" << B.getjumlahreservasi();
                    for(int i = 0; i < spasi_jumlah_reservasi - static_cast<int>(to_string(B.getjumlahreservasi()).length()); i++){
                        cout << " ";
                    }
                    cout << "|";
                    cout << endl;
                    for(int i = 0; i < spasi_alamat + spasi_nama_lounge + spasi_nama_restoran + spasi_kota + spasi_id + spasi_kapasitas_lounge + spasi_harga_tiket_premium + spasi_jumlah_meja + spasi_jumlah_reservasi + spasi_nama + spasi_jumlah + 7; i++){
                        cout << "-";
                    }
                    cout << endl;
                }
            }
        }
        //salah satu opsi perintah, perintah ini untuk menampilkan kembali
        //menu awal yang isinya penjelasan setiap perintah
        //saya buat perintah ini agar user yang lupa perintah perintah nya
        //bisa mengetahui nya kembali dengan perintah ini
        else if(pilihan == "help" || pilihan == "Help"){
            cout << "<<<<<<<<<<<< Menu utak atik data bioskop >>>>>>>>>>>>>" << endl;
            cout << endl;
            cout << "insert: Untuk tambah data baru" << endl;
            cout << "show: Untuk menampilkan data yang ada << endl";
            cout << "Exit: Untuk keluar dari program" << endl;
            cout << "Help: untuk melihat perintah pada program ini" << endl;
        }
        //jika user memasukan perintah selain yang saya seddiakan
        else{
            //kondisi untuk mengatasi jika user memasukan exit
            //karena exit tidak saya masukan ke perkondisian karena bagian dari kondisi
            //untukk mengakhiri program
            if(pilihan != "exit" && pilihan != "Exit"){
                cout << "Perintah tidak dikenali... (nyawit ni)\n";
            }
        }
        //Program atau algoritma berhenti jika user memasukan exit atau Exit
    }while(pilihan != "exit" && pilihan != "Exit");




    return 0;
}