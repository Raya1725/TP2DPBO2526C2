import java.util.Scanner;
import java.util.ArrayList;
import java.util.Iterator;

public class Main{
    public static void main(String[] args) {
        //menambahkan 5 objek awal
        
        //deklarasi arraylist atau bisa dibilang bungkusan untuk
        //menyimpan banyak data berupa class bioskop
        ArrayList<BioskopLuxury> daftarBioskop = new ArrayList<>();
        BioskopLuxury awal = new BioskopLuxury(1, "XXI", "JL Kolmas", 7, "Bandung","Lounge Bahari", 12, 1200000, "LA Beau", 5, 3);
        daftarBioskop.add(awal);
        awal = new BioskopLuxury(2, "CGV", "JL SumurBor", 6, "Bandung","Lounge Bihara", 8, 150000, "LA BauBau", 10, 15);
        daftarBioskop.add(awal);
        awal = new BioskopLuxury(3, "Cinepolis", "JL Sumbang", 8, "Jakarta","Lounge bambang", 2, 80000, "Mang Bahar", 20, 2);
        daftarBioskop.add(awal);
        awal = new BioskopLuxury(4, "Reynema", "JL Cimareme", 10, "Bandung","Lounge Sultan", 20, 200000, "LA LA LA", 20, 21);
        daftarBioskop.add(awal);
        awal = new BioskopLuxury(5, "NoeNema", "JL Cantik", 17, "Bandung","Lounge Beautiful", 17, 170307, "LA Pretty", 17, 17);
        daftarBioskop.add(awal);
        //untuk meminta masukan, saya mendeklarasikan scanner bernama sc
        //agar bisa membuat kode yang meminta masukan user
        Scanner sc = new Scanner(System.in);
        String pilihan;
        System.out.println("<<<<<<<<<<<< Menu utak atik data bioskop >>>>>>>>>>>>>");
        System.out.println(" ");
        System.out.println("insert: Untuk tambah data baru");
        System.out.println("Show: Untuk menampilkan data yang ada");
        System.out.println("Exit: Untuk keluar dari program");
        System.out.println("Help: jika lupa apa saja perintah yang ada");
        //perulangan sampai user memasukan perintah exit atau Exit
        //huruf besar huruf kecil tidak berpengaruh disini
        do{
            //deklarasi iterator baru untuk menunjuk ke elemen di dalam bungkusan
            //bernama daftarbioskop
            Iterator<BioskopLuxury> iter = daftarBioskop.iterator();
            System.out.println(" ");
            System.out.print("Masukan perintah : ");
            pilihan = sc.nextLine();
            /*
            jika user memasukan insert sebagai perintah, perintah ini
            adalah untuk user memasukan data ke dalam bungkusan daftarbioskop
            user diminta memasukan id, nama, alamat dll
            */
            if("insert".equalsIgnoreCase(pilihan)){
                int id = 0;
                System.out.print("Masukan id: ");
                //perulangan ini untuk mencegah user memasukan masukan selain angka untuk atribut id
                while(!sc.hasNextInt()){
                    System.out.print("Masukan hanya angka: ");
                    sc.next();
                }
                id = sc.nextInt();
                sc.nextLine();
                //perulangan ini adalah untuk mngecek apakah atribut id dengan masukan dari user
                //sudah ada atau belum di dalam arraylist
                while(iter.hasNext()){
                    BioskopLuxury B = iter.next();
                    //kondisi jika masukan user sudah ada dalam arraylist
                    if(B.getid() == id){
                        int id_ada = B.getid();
                        //perulangan untuk user agar memasukan data yang benar
                        while(id_ada == id){
                            System.out.print("Id sudah ada, masukan yang lain: ");
                            while(!sc.hasNextInt()){
                                System.out.print("Masukan hanya angka: ");
                                sc.next();
                            }
                            id = sc.nextInt();
                            sc.nextLine();
                        }
                    }
                }
                System.out.print("Masukan Nama: ");
                String nama = sc.nextLine();
                System.out.print("Masukan Alamat: ");
                String alamat = sc.nextLine();
                System.out.print("Masukan Jumlah Studio: ");
                while(!sc.hasNextInt()){//ini adalah perulangan yang sama dengan yang ada di id
                    System.out.print("Masukan hanya angka: ");
                    sc.next();
                }
                int jumlah_studio = sc.nextInt(); 
                sc.nextLine();
                System.out.print("Masukan Kota: ");
                String kota = sc.nextLine();
                System.out.print("Masukan nama lounge: ");
                String nama_lounge = sc.nextLine();
                System.out.print("Masukan kapasitas lounge: ");
                while(!sc.hasNextInt()){
                    System.out.print("Masukan hanya angka: ");
                    sc.next();
                }
                int kapasitas_lounge = sc.nextInt();
                sc.nextLine();
                System.out.print("Masukan harga tiket premium: ");
                while(!sc.hasNextDouble()){
                    System.out.print("Masukan hanya angka: ");
                    sc.next();
                }
                double harga_tiket_premium = sc.nextDouble();
                sc.nextLine();
                System.out.print("Masukan nama restoran: ");
                String nama_restoran = sc.nextLine();
                System.out.print("Masukan nama jumlah meja: ");
                while(!sc.hasNextInt()){
                    System.out.print("Masukan hanya angka: ");
                    sc.next();
                }
                int jumlah_meja = sc.nextInt();
                System.out.print("Masukan jumlah_reservasi: ");
                while(!sc.hasNextInt()){
                    System.out.print("Masukan hanya angka: ");
                    sc.next();
                }
                int jumlah_reservasi = sc.nextInt();
                sc.nextLine();
                //memasukan data yang dimasukan tadi ke dalam konstruk bioskop yang baru
                BioskopLuxury B = new BioskopLuxury(id, nama, alamat, jumlah_studio, kota, nama_lounge, kapasitas_lounge, harga_tiket_premium, nama_restoran, jumlah_meja, jumlah_reservasi);
                daftarBioskop.add(B);//lalu memasukan bioskop baru yang tadi ke dalam arraylist/bungkusan
                System.out.println("data berhasil dimasukan coyy uhuyyy geloo brutal");
            }
            //perintah untuk menampilkan semua data yang tersedia di dalam bungkusan
            else if("show".equalsIgnoreCase(pilihan)){
                //jika bungkusan kosong
                if(daftarBioskop.isEmpty()){
                    System.out.println("Kosong loh yahhh");
                }
                else{
                    //semua variabel untuk menyimpan data masing masing spasi agar tabel rapih
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
                    /*
                    melakukan for each atau perulangan sesuai jumlah data yang ada dalam
                    bungkusan daftarbioskop
                    perulangan ini bertujuan untuk mencari data paling panjang di masing masin
                    atribut
                    */
                    for (BioskopLuxury b : daftarBioskop) {
                        spasi_nama   = Math.max(spasi_nama, b.getnama().length() + 2);
                        if(spasi_nama < String.valueOf("Nama").length()){
                            spasi_nama = String.valueOf("Nama").length();
                        }
                        spasi_nama_lounge   = Math.max(spasi_nama_lounge, b.getnama_lounge().length() + 2);
                        if(spasi_nama_lounge < String.valueOf("Nama Lounge").length()){
                            spasi_nama_lounge = String.valueOf("Nama lounge").length();
                        }
                        spasi_nama_restoran   = Math.max(spasi_nama_restoran, b.getnama_restoran().length() + 2);
                        if(spasi_nama_restoran < String.valueOf("Nama restoran").length()){
                            spasi_nama_restoran = String.valueOf("Nama restran").length();
                        }
                        spasi_alamat = Math.max(spasi_alamat, b.getalamat().length() + 2);
                        if(spasi_alamat < String.valueOf("Alamat").length()){
                            spasi_alamat = String.valueOf("Alamat").length();
                        }
                        spasi_kota   = Math.max(spasi_kota, b.getkota().length() + 2);
                        if(spasi_kota < String.valueOf("Kota").length()){
                            spasi_kota = String.valueOf("Kota").length();
                        }
                        spasi_id = Math.max(spasi_id, String.valueOf(b.getid()).length() + 2);
                        if(spasi_id < String.valueOf("Id").length()){
                            spasi_id = String.valueOf("Id").length();
                        }
                        spasi_jumlah = Math.max(spasi_jumlah, String.valueOf(b.getjumlah_studio()).length() + 2);
                        if(spasi_jumlah < String.valueOf("Jumlah Studio").length()){
                            spasi_jumlah = String.valueOf("Jumlah Studio").length();
                        }
                        spasi_kapasitas_lounge = Math.max(spasi_kapasitas_lounge, String.valueOf(b.getkapasitas_lounge()).length() + 2);
                        if(spasi_kapasitas_lounge < String.valueOf("Kapasitas Lounge").length()){
                            spasi_kapasitas_lounge = String.valueOf("Kapasitas Lounge").length();
                        }
                        spasi_harga_tiket_premium = Math.max(spasi_harga_tiket_premium, String.valueOf(b.getharga_tiket_premium()).length() + 2);
                        if(spasi_harga_tiket_premium < String.valueOf("Harga Tiket (Rp)").length()){
                            spasi_harga_tiket_premium = String.valueOf("Harga Tiket (Rp)").length();
                        }
                        spasi_jumlah_meja = Math.max(spasi_jumlah_meja, String.valueOf(b.getjumlah_meja()).length() + 2);
                        if(spasi_jumlah_meja < String.valueOf("Jumlah Meja").length()){
                            spasi_jumlah_meja = String.valueOf("Jumlah Meja").length();
                        }
                        spasi_jumlah_reservasi = Math.max(spasi_jumlah_reservasi, String.valueOf(b.getjumlah_reservasi()).length() + 2);
                        if(spasi_jumlah_reservasi < String.valueOf("Jumlah Reservasi (orang)").length()){
                            spasi_jumlah_reservasi = String.valueOf("Jumlah Reservasi (orang)").length();
                        }
                    }
                    //mulai menampilkan data dengan tabel
                    System.out.println("Daftar Bioskop yang tersedia: ");
                    for(int i = 0; i < spasi_alamat + spasi_nama_lounge + spasi_nama_restoran + spasi_kota + spasi_id + spasi_kapasitas_lounge + spasi_harga_tiket_premium + spasi_jumlah_meja + spasi_jumlah_reservasi + spasi_nama + spasi_jumlah + 13; i++){
                        System.out.print("-");
                    }
                    System.out.println();
                    System.out.print("|ID");
                    for(int i = 0; i < spasi_id - String.valueOf("ID").length(); i++){
                        System.out.print(" ");
                    }
                    System.out.print("|Nama");
                    for(int i = 0; i < spasi_nama - String.valueOf("Nama").length(); i++){
                        System.out.print(" ");
                    }
                    System.out.print("|Alamat");
                    for(int i = 0; i < spasi_alamat - String.valueOf("Alamat").length(); i++){
                        System.out.print(" ");
                    }
                    System.out.print("|Jumlah Studio");
                    for(int i = 0; i < spasi_jumlah - String.valueOf("Jumlah Studio").length(); i++){
                        System.out.print(" ");
                    }
                    System.out.print("|kota");
                    for(int i = 0; i < spasi_kota - String.valueOf("kota").length(); i++){
                        System.out.print(" ");
                    }
                    System.out.print("|Nama Lounge");
                    for(int i = 0; i < spasi_nama_lounge - String.valueOf("Nama_lounge").length(); i++){
                        System.out.print(" ");
                    }
                    System.out.print("|Kapasitas Lounge");
                    for(int i = 0; i < spasi_kapasitas_lounge - String.valueOf("Kapasitas Lounge").length(); i++){
                        System.out.print(" ");
                    }
                    System.out.print("|Harga Tiket (Rp)");
                    for(int i = 0; i < spasi_harga_tiket_premium - String.valueOf("Harga Tiket (Rp)").length(); i++){
                        System.out.print(" ");
                    }
                    System.out.print("|Nama Restoran");
                    for(int i = 0; i < spasi_nama_restoran - String.valueOf("Nama Restoran").length(); i++){
                        System.out.print(" ");
                    }
                    System.out.print("|Jumlah Meja");
                    for(int i = 0; i < spasi_jumlah_meja - String.valueOf("Jumlah Meja").length(); i++){
                        System.out.print(" ");
                    }
                    System.out.print("|Jumlah Reservasi (orang)");
                    for(int i = 0; i < spasi_jumlah_reservasi - String.valueOf("Jumlah Reservasi (orang)").length(); i++){
                        System.out.print(" ");
                    }
                    
                    System.out.print("|");
                    System.out.println();
                    for(int i = 0; i < spasi_alamat + spasi_nama_lounge + spasi_nama_restoran + spasi_kota + spasi_id + spasi_kapasitas_lounge + spasi_harga_tiket_premium + spasi_jumlah_meja + spasi_jumlah_reservasi + spasi_nama + spasi_jumlah + 13; i++){
                        System.out.print("-");
                    }
                    System.out.println();
                    for(BioskopLuxury B : daftarBioskop){
                        System.out.print("|" + B.getid());
                        for(int i = 0; i < spasi_id - String.valueOf(B.getid()).length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|" + B.getnama());
                        for(int i = 0; i < spasi_nama - B.getnama().length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|" + B.getalamat());
                        for(int i = 0; i < spasi_alamat - B.getalamat().length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|" + B.getjumlah_studio());
                        for(int i = 0; i < spasi_jumlah - String.valueOf(B.getjumlah_studio()).length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|" + B.getkota());
                        for(int i = 0; i < spasi_kota - B.getkota().length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|" + B.getnama_lounge());
                        for(int i = 0; i < spasi_nama_lounge - B.getnama_lounge().length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|" + B.getkapasitas_lounge());
                        for(int i = 0; i < spasi_kapasitas_lounge - String.valueOf(B.getkapasitas_lounge()).length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|" + B.getharga_tiket_premium());
                        for(int i = 0; i < spasi_harga_tiket_premium - String.valueOf(B.getharga_tiket_premium()).length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|" + B.getnama_restoran());
                        for(int i = 0; i < (spasi_nama_restoran + 1) - B.getnama_restoran().length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|" + B.getjumlah_meja());
                        for(int i = 0; i < spasi_jumlah_meja - String.valueOf(B.getjumlah_meja()).length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|" + B.getjumlah_reservasi());
                        for(int i = 0; i < spasi_jumlah_reservasi - String.valueOf(B.getjumlah_reservasi()).length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|");
                        System.out.println();
                        for(int i = 0; i < spasi_alamat + spasi_nama_lounge + spasi_nama_restoran + spasi_kota + spasi_id + spasi_kapasitas_lounge + spasi_harga_tiket_premium + spasi_jumlah_meja + spasi_jumlah_reservasi + spasi_nama + spasi_jumlah + 13; i++){
                        System.out.print("-");
                        }
                        System.out.println();
                    }
                }
            }
            /*
            perintah ini adalah perintah ketika user nya lupa apa saja yang bisa
            dilakukan di program ini, cukup ketik help saja dan akan keluar peuntujuk nya
            */
            else if("help".equalsIgnoreCase(pilihan)){
                System.out.println("<<<<<<<<<<<< Menu utak atik data bioskop >>>>>>>>>>>>>");
                System.out.println(" ");
                System.out.println("insert: Untuk tambah data baru");
                System.out.println("Show: Untuk menampilkan data yang ada");
                System.out.println("Exit: Untuk keluar dari program");
                System.out.println("Help: jika lupa apa saja perintah yang ada");
            }
            /*
            jika perintah nya tidak sesuai dengan perintah yang sudah disediakan tetapi
            tidak dengan perintah exit, karena perintah exit adalah perintah untuk
            mengakhiri program
            */
            else{
                if(!"exit".equalsIgnoreCase(pilihan)){
                    System.out.println("Perintah tidak dikenali... (nyawit ni)");
                }
            }
        }while(!"exit".equalsIgnoreCase(pilihan));
        sc.close();
    }
}
