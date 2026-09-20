#include <iostream>
#include <vector>
#include <algorithm>
#include <string>
#include <limits>
#include "Bioskop.cpp"
using namespace std;

int main(){

    ios::sync_with_stdio(0);

    //deklarasi vector baru dengan nama daftar bioskop untuk menyimpan data bioskop
    vector<Bioskop> daftarbioskop;  
    string pilihan;
    cout << "<<<<<<<<<<<< Menu utak atik data bioskop >>>>>>>>>>>>>" << endl;
    cout << endl;
    cout << "insert: Untuk tambah data baru" << endl;
    cout << "show: Untuk menampilkan data yang ada" << endl;
    cout << "Update: Untuk mengedit data yang ada" << endl;
    cout << "Delete: Untuk menghapus data" << endl;
    cout << "Search: untuk mencari data" << endl;
    cout << "Exit: Untuk keluar dari program" << endl;
    cout << "Help: untuk melihat perintah pada program ini" << endl;
    do{//perulangan do while atau meminta masukan dulu baru mengecek kondisi di akhir
        vector<Bioskop>:: iterator iter = daftarbioskop.begin();//deklarasi iterator atau pengecek untuk vector daftarbioskop
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
            //memasukan data dengan konstruk bioskopp baru lalu sekalian memasukan data kedalamnya
            Bioskop B = Bioskop(id, nama, alamat, jumlah_studio, kota);
            daftarbioskop.push_back(B);//memasukan data ke dalam vector
            cout << "Data Berhasil Dimasukan, geloooo disini juga berhasill" << endl;
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
                //perulangan for untuk melakukan perhitungan masing masing spasi
                for (Bioskop B : daftarbioskop) {
                    spasi_id     = max(spasi_id,     static_cast<int>(to_string(B.getid()).length() + 2));
                    spasi_jumlah = max(spasi_jumlah, static_cast<int>(to_string(B.getjumlah_studio()).length() + 2));
                    spasi_nama   = max(spasi_nama,   static_cast<int>(B.getnama().length() + 2));
                    spasi_alamat = max(spasi_alamat, static_cast<int>(B.getalamat().length() + 2));
                    spasi_kota   = max(spasi_kota,   static_cast<int>(B.getkota().length() + 2));
                }
                //Menampilkan data Bioskop yang tersedia atau yang ada
                //data ditampilkan dalam format tabel yang dinamis menyesuaikan panjang dari setiap data 
                cout << "Daftar Bioskop yang Tersedia: " << endl;
                for(int i = 0; i < spasi_alamat + spasi_kota + spasi_nama + 53; i++){
                    cout << "_";
                }
                cout << endl;
                for(Bioskop B : daftarbioskop){
                    cout << "|Id: " << B.getid();
                    for(int i = 0; i < spasi_id - to_string(B.getid()).length(); i++){
                        cout << " ";
                    }
                    cout << "|Nama: " << B.getnama();
                    for(int i = 0; i < spasi_nama - B.getnama().length(); i++){
                        cout << " ";
                    }
                    cout << "|Alamat: " << B.getalamat();
                    for(int i = 0; i < spasi_alamat - B.getalamat().length(); i++){
                        cout << " ";
                    }
                    cout << "|Jumlah_studio: " << B.getjumlah_studio();
                    for(int i = 0; i < spasi_jumlah - to_string(B.getjumlah_studio()).length(); i++){
                        cout << " ";
                    }
                    cout << "|Kota: " << B.getkota();
                    for(int i = 0; i < spasi_kota - B.getkota().length(); i++){
                        cout << " ";
                    }
                    cout << "|";
                    cout << endl;
                }
                for(int i = 0; i < spasi_alamat + spasi_kota + spasi_nama + 53; i++){
                    cout << "-";
                }
                cout << endl;
            }
        }
        //salah satu opsi perintah yaitu update
        //update adalah mengedit isi atribut dari suatu data seperti nama, alamat dll
        //algoritma update menggunakan id sebagai parameter data mana yang mau di ubah
        else if(pilihan == "update" || pilihan == "Update"){
            cout << "Masukan id bioskop yang mau diubah: ";
            int ubah = 0;
            cin >> ubah;
            while(cin.fail()){
                cin.clear();
                cin.ignore(numeric_limits<streamsize>::max(), '\n');
                cout << "Masukan hanya angka: ";
                cin >> ubah;
            }
            bool ketemu = false;
            iter = daftarbioskop.begin();
            //perulangan sampai bertemu data yang sesuai dengan id yang dimasukan
            //jika tidak ketemu maka algoritma akan mengeluarkan kalimat bahwa data tidak ditemukan
            while(ketemu == false && iter != daftarbioskop.end()){
                Bioskop &B = *iter;
                if(B.getid() == ubah){//kondisi jika data ditemukan
                    ketemu = true;
                    //disini saya memberikan banyak opsi untuk data apa yang mau diubah
                    /*
                    contohnya jika user memasukan nomor 1, maka user akan diminta
                    memasukan nama baru untuk mengganti nama yang ada di dalam vector
                    */
                    cout << "apa yang mau diubah: " << endl;
                    cout << "1, Nama: " << endl;
                    cout << "2, Alamat: " << endl;
                    cout << "3, Jumlah Studio: " << endl;
                    cout << "4, Kota: " << endl;
                    cout << "5, semua (Kecuali id): " << endl;
                    cout << "Masukan Nomor: ";
                    int update_pilihan;
                    cin >> update_pilihan;
                    while(cin.fail()){
                        cin.clear();
                        cin.ignore(numeric_limits<streamsize>::max(), '\n');
                        cout << "Masukan hanya angka: ";
                        cin >> update_pilihan;
                    }
                    cin.ignore();
                    //berbagai kondisi sesuai apa yang dipilih oleh user
                    if(update_pilihan == 1){
                        cout << "Masukan nama: ";
                        string nama;
                        getline(cin, nama);
                        B.setnama(nama);
                        cout << "Pergantian nama berhasil...." << endl;
                    }
                    else if(update_pilihan == 2){
                        cout << "Masukan alamat: ";
                        string alamat;
                        getline(cin, alamat);
                        B.setalamat(alamat);
                        cout << "Pergantian alamat berhasil...." << endl;
                    }
                    else if(update_pilihan == 3){
                        cout << "Masukan jumlah studio: ";
                        int jumlah;
                        cin >> jumlah;
                        while(cin.fail()){
                            cin.clear();
                            cin.ignore(numeric_limits<streamsize>::max(), '\n');
                            cout << "Masukan hanya angka: ";
                            cin >> jumlah;
                        }
                        cin.ignore();
                        B.setjumlah_studio(jumlah);
                        cout << "Pergantian jumlah studio berhasil...." << endl;
                    }
                    else if(update_pilihan == 4){
                        cout << "Masukan kota: ";
                        string kota;
                        getline(cin, kota);
                        B.setkota(kota);
                        cout << "Pergantian kota berhasil...." << endl;
                    }
                    else if(update_pilihan == 5){
                        cout << "Masukan nama: " ;
                        string semua;
                        getline(cin, semua);
                        B.setnama(semua);
                        cout << "Masukan alamat: ";
                        getline(cin, semua);
                        B.setalamat(semua);
                        int angka;
                        cout << "Masukan jumlah studio: ";
                        cin >> angka;
                        while(cin.fail()){
                            cin.clear();
                            cin.ignore(numeric_limits<streamsize>::max(), '\n');
                            cout << "Masukan hanya angka: ";
                            cin >> angka;
                        }
                        cin.ignore();
                        B.setjumlah_studio(angka);
                        cout << "Masukan jumlah kota: ";
                        getline(cin, semua);
                        B.setkota(semua);
                        cout << "Pergantian seluruh data berhasil...." << endl;
                    }
                }
                //jika data tidak ditemukan maka iterator akan maju
                else{
                    iter++;
                }
            }
            if(ketemu == false){
                cout << "data tidak ditemukan....." << endl;
            }
        }
        //salah satu opsi perintah yaitu delete
        //fungsi peintah ini adalah untuk menghapus data di dalam vector sesuai masukan user
        //user diminta memasukan data berupa id lalu dicocokan ke dalam data dalam vector
        //setelah itu data akan terhapus
        else if(pilihan == "delete" || pilihan == "Delete"){
            cout << "Masukan id bioskop yang mau dihapus: ";
            int hapus = 0;
            cin >> hapus;
            while(cin.fail()){
                cin.clear();
                cin.ignore(numeric_limits<streamsize>::max(), '\n');
                cout << "Masukan hanya angka: ";
                cin >> hapus;
            }
            cin.ignore();
            bool ketemu = false;
            iter = daftarbioskop.begin();
            while(ketemu == false && iter != daftarbioskop.end()){
                if(iter->getid() == hapus){
                    ketemu = true;
                    iter = daftarbioskop.erase(iter);
                    cout << "data berhasil dihapus...." << endl;
                }
                else{
                    iter++;
                }
            }
            //kondisi jika data id masukan user tidak ditemukan dalam vector
            if(ketemu == false){
                cout << "data tidak ditemukan..." << endl;
            }
        }
        //salah satu opsi perintah yaitu search atau untuk melakukan pencarian data spesifik
        //user diminta memasukan data berupa id, lalu algoritma akan menampilkan
        //data nama, alamat dll yang sesuai dengan id yang dimasukan user
        else if(pilihan == "search" || pilihan == "Search"){
            cout << "Masukan id bioskop yang mau dicari: ";
            int cari = 0;
            cin >> cari;
            while(cin.fail()){
                cin.clear();
                cin.ignore(numeric_limits<streamsize>::max(), '\n');
                cout << "Masukan hanya angka: ";
                cin >> cari;
            }
            cin.ignore();
            bool ketemu = false;
            iter = daftarbioskop.begin();
            //perulangan untuk mencari data sesuai masukan user
            while(ketemu == false && iter != daftarbioskop.end()){
                if(iter->getid() == cari){
                    ketemu = true;
                    cout << "Id: "<< iter->getid() << endl;
                    cout << "Nama: "<< iter->getnama() << endl;
                    cout << "Alamat: " << iter->getalamat() << endl;
                    cout << "jumlah studio: "<< iter->getjumlah_studio() << endl;
                    cout << "Kota: " << iter->getkota() << endl;
                }
                else{
                    iter++;
                }
            }
            if(ketemu == false){
                cout << "data tidak ditemukan..." << endl;
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
            cout << "Update: Untuk mengedit data yang ada" << endl;
            cout << "Delete: Untuk menghapus data" << endl;
            cout << "Search: untuk mencari data" << endl;
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