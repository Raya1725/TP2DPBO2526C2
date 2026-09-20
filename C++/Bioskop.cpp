using namespace std;

//deklarasi kelas baru dengan nama Bioskop
class Bioskop {
private:
    int id;
    string nama;
    string alamat;
    int jumlah_studio;
    string kota;

public:
    Bioskop(){//konstruktor untuk class Bioskop

    }
    /*
    konstruktor juga, konstruktor ini digunakan jika user mau langsung
    memasukan data ke dalam class nya, ibaratnya konstruktor tapi dengan isi nya
    */
    Bioskop(int id, string nama, string alamat, int jumlah_studio, string kota){
        this->id = id;
        this->nama = nama;
        this->alamat = alamat;
        this->jumlah_studio = jumlah_studio;
        this->kota = kota;
    }
    //metode untuk meminta data dan men set atau memasukan data 
    void setid(int id){
        this->id = id;
    }
    int getid(){
        return this->id;
    }
    void setnama(string nama){
        this->nama = nama;
    }
    string getnama(){
        return this->nama;
    }
    void setalamat(string alamat){
        this->alamat = alamat;
    }
    string getalamat(){
        return this->alamat;
    }
    void setjumlah_studio(int jumlah_studio){
        this->jumlah_studio = jumlah_studio;
    }
    int getjumlah_studio(){
        return this->jumlah_studio;
    }
    void setkota(string kota){
        this->kota = kota;
    }
    string getkota(){
        return this->kota;
    }
};