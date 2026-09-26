#include "Bioskop.cpp"

using namespace std;

class BioskopPremium : public Bioskop{
    private :
        string nama_lounge;
        int kapasitas_lounge;
        double harga_tiket;
    
    public :
        BioskopPremium(){

        }
        
        BioskopPremium(int id, string nama, string alamat, int jumlah_studio, string kota, 
        string nama_lounge, int kapasitas_lounge, double harga_tiket) : Bioskop(id, nama, alamat, jumlah_studio, kota){
            this->nama_lounge = nama_lounge;
            this->kapasitas_lounge = kapasitas_lounge;
            this->harga_tiket = harga_tiket;
        }
        
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

        ~BioskopPremium(){}
        
};