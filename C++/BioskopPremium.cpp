#include "Bioskop.cpp"

using namespace std;

//deklarasi class BioskopPremium yang inheritage dengan class Bioskop
class BioskopPremium : public Bioskop{
    private :
        //deklarasi berbagai atribut
        string nama_lounge;
        int kapasitas_lounge;
        double harga_tiket;
    
    public :
        //sebuah konstruktor untuk kelas ini
        BioskopPremium(){

        }
        
        //konstuktor juga tetapi berparameter
        BioskopPremium(int id, string nama, string alamat, int jumlah_studio, string kota, 
        string nama_lounge, int kapasitas_lounge, double harga_tiket) : Bioskop(id, nama, alamat, jumlah_studio, kota){
            this->nama_lounge = nama_lounge;
            this->kapasitas_lounge = kapasitas_lounge;
            this->harga_tiket = harga_tiket;
        }
        
        //berbagai method getset
        void setnamalounge(string nama_lounge){
            this->nama_lounge = nama_lounge;
        }
        
        string getnamalounge(){
            return this->nama_lounge;
        }

        void setkapasitaslounge(int kapasitas_lounge){
            this->kapasitas_lounge = kapasitas_lounge;
        }
        
        int getkapasitaslounge(){
            return this->kapasitas_lounge;
        }

        void sethargatiket(double harga_tiket){
            this->harga_tiket = harga_tiket;
        }
        
        double gethargatiket(){
            return this->harga_tiket;
        }

        //dekonstruktor untuk kelas ini
        ~BioskopPremium(){}
        
};