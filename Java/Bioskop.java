//membuat class public dengan nama bioskop beserta atribut nya
public class Bioskop {
    private int id;
    private String nama;
    private String alamat;
    private int jumlah_studio;
    private String kota;
    
    //sebuah konstruk untuk class Bioskop
    Bioskop(){

    }
    //konstruk juga tetapi dengan meminta masukan juga agar data bisa langsung terisi
    Bioskop(int id, String nama, String alamat, int jumlah_studio, String kota){
        this.id = id;
        this.nama = nama;
        this.alamat = alamat;
        this.jumlah_studio = jumlah_studio;
        this.kota = kota;
    }
    //semua method untuk mendapatkan data dari class dan memasukan data ke class
    //set untuk memasukan data, get untuk mengambil data
    void setid(int id){
        this.id = id;
    }
    int getid(){
        return this.id;
    }
    void setnama(String nama){
        this.nama = nama;
    }
    String getnama(){
        return this.nama;
    }
    void setalamat(String alamat){
        this.alamat = alamat;
    }
    String getalamat(){
        return this.alamat;
    }
    void setjumlah_studio(int jumlah_studio){
        this.jumlah_studio = jumlah_studio;
    }
    int getjumlah_studio(){
        return this.jumlah_studio;
    }
    void setkota(String kota){
        this.kota = kota;
    }
    String getkota(){
        return this.kota;
    }

}
