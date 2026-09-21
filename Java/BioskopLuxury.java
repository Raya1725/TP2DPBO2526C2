public class BioskopLuxury extends BioskopPremium{
    private String nama_restoran;
    private int jumlah_meja;
    private int jumlah_reservasi;

    public BioskopLuxury(){

    }

    public BioskopLuxury(int id, String nama, String alamat, int jumlah_studio, String kota,
    String nama_lounge, int kapasitas_lounge, double harga_tiket_premium,
    String nama_restoran, int jumlah_meja, int jumlah_reservasi){
        super(id, nama, alamat, jumlah_studio, kota, nama_lounge, kapasitas_lounge, harga_tiket_premium);
        this.nama_restoran = nama_restoran;
        this.jumlah_meja = jumlah_meja;
        this.jumlah_reservasi = jumlah_reservasi;
    }

    String getnama_restoran(){
        return this.nama_restoran;
    }

    void setnama_restoran(String nama_restoran){
        this.nama_restoran = nama_restoran;
    }
    int getjumlah_meja(){
        return this.jumlah_meja;
    }

    void setjumlah_meja(int jumlah_meja){
        this.jumlah_meja = jumlah_meja;
    }
    int getjumlah_reservasi(){
        return this.jumlah_reservasi;
    }

    void setjumlah_reservasi(int jumlah_reservasi){
        this.jumlah_reservasi = jumlah_reservasi;
    }
    
}
