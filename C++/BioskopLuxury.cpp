#include <iostream>
#include <string>
#include "BioskopPremium.cpp"

using namespace std;

class BioskopLuxury : public BioskopPremium {
    private : 
        string nama_restoran;
        int jumlah_meja;
        int jumlah_reservasi;
    
    public :
        BioskopLuxury(){

        }

        BioskopLuxury(int id, string nama, string alamat, int jumlah_studio, string kota, 
        string nama_lounge, int kapasitas_lounge, double harga_tiket, 
        string nama_restoran, int jumlah_meja, int jumlah_reservasi) : BioskopPremium(id, nama, alamat, jumlah_studio, kota, nama_lounge, kapasitas_lounge, harga_tiket){
            this->nama_restoran = nama_restoran;
            this->jumlah_meja = jumlah_meja;
            this->jumlah_reservasi = jumlah_reservasi;
        }

        void setnamarestoran(string nama_restoran){
            this->nama_restoran = nama_restoran;
        }

        string getnamarestoran(){
            return this->nama_restoran;
        }

        void setjumlahmeja(int jumlah_meja){
            this->jumlah_meja = jumlah_meja;
        }

        int getjumlahmeja(){
            return this->jumlah_meja;
        }

        void setjumlahreservasi(int jumlah_reservasi){
            this->jumlah_reservasi = jumlah_reservasi;
        }

        int getjumlahreservasi(){
            return this->jumlah_reservasi;
        }

        
};