public class BioskopPremium extends Bioskop{
    private String nama_lounge;
    private int kapasitas_lounge;
    private double harga_tiket_premium;

    public BioskopPremium(){

    }

    public BioskopPremium(int id, String nama, String alamat, int jumlah_studio, String kota,
    String nama_lounge, int kapasitas_lounge, double harga_tiket_premium){

        super(id, nama, alamat, jumlah_studio, kota);
        this.nama_lounge = nama_lounge;
        this.kapasitas_lounge = kapasitas_lounge;
        this.harga_tiket_premium = harga_tiket_premium;
    }

    String getnama_lounge(){
        return this.nama_lounge;
    }

    void setnama_lounge(String nama_lounge){
        this.nama_lounge = nama_lounge;
    }
    int getkapasitas_lounge(){
        return this.kapasitas_lounge;
    }

    void setkapasitas_lounge(int kapasitas_lounge){
        this.kapasitas_lounge = kapasitas_lounge;
    }
    double getharga_tiket_premium(){
        return this.harga_tiket_premium;
    }

    void setharga_tiket_premium(double harga_tiket_premium){
        this.harga_tiket_premium = harga_tiket_premium;
    }
    
}
