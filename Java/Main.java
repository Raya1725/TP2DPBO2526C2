import java.util.Scanner;
import java.util.ArrayList;
import java.util.Iterator;

public class Main{
    public static void main(String[] args) {
        //deklarasi arraylist atau bisa dibilang bungkusan untuk
        //menyimpan banyak data berupa class bioskop
        ArrayList<Bioskop> daftarBioskop = new ArrayList<>();
        //untuk meminta masukan, saya mendeklarasikan scanner bernama sc
        //agar bisa membuat kode yang meminta masukan user
        Scanner sc = new Scanner(System.in);
        String pilihan;
        System.out.println("<<<<<<<<<<<< Menu utak atik data bioskop >>>>>>>>>>>>>");
        System.out.println(" ");
        System.out.println("insert: Untuk tambah data baru");
        System.out.println("Show: Untuk menampilkan data yang ada");
        System.out.println("Update: Untuk mengedit data yang ada");
        System.out.println("Delete: Untuk menghapus data");
        System.out.println("Search: untuk mencari data");
        System.out.println("Exit: Untuk keluar dari program");
        System.out.println("Help: untuk melihat perintah pada program ini");
        System.out.println("Penggunaan huruf besar dan kecil tidak berpengaruh");
        //perulangan sampai user memasukan perintah exit atau Exit
        //huruf besar huruf kecil tidak berpengaruh disini
        do{
            //deklarasi iterator baru untuk menunjuk ke elemen di dalam bungkusan
            //bernama daftarbioskop
            Iterator<Bioskop> iter = daftarBioskop.iterator();
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
                    Bioskop B = iter.next();
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
                //memasukan data yang dimasukan tadi ke dalam konstruk bioskop yang baru
                Bioskop B = new Bioskop(id, nama, alamat, jumlah_studio, kota);
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
                    /*
                    melakukan for each atau perulangan sesuai jumlah data yang ada dalam
                    bungkusan daftarbioskop
                    perulangan ini bertujuan untuk mencari data paling panjang di masing masin
                    atribut
                    */
                    for (Bioskop b : daftarBioskop) {
                        spasi_nama   = Math.max(spasi_nama, b.getnama().length() + 2);
                        spasi_alamat = Math.max(spasi_alamat, b.getalamat().length() + 2);
                        spasi_kota   = Math.max(spasi_kota, b.getkota().length() + 2);
                        spasi_id     = Math.max(spasi_id, String.valueOf(b.getid()).length() + 2);
                        spasi_jumlah = Math.max(spasi_jumlah, String.valueOf(b.getjumlah_studio()).length() + 2);
                    }
                    //mulai menampilkan data dengan tabel
                    System.out.println("Daftar Bioskop yang tersedia: ");
                    for(int i = 0; i < spasi_alamat + spasi_kota + spasi_nama + 53; i++){
                        System.out.print("_");
                    }
                    System.out.println();
                    for(Bioskop B : daftarBioskop){
                        System.out.print("|Id: " + B.getid());
                        for(int i = 0; i < spasi_id - String.valueOf(B.getid()).length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|Nama: " + B.getnama());
                        for(int i = 0; i < spasi_nama - B.getnama().length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|Alamat: " + B.getalamat());
                        for(int i = 0; i < spasi_alamat - B.getalamat().length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|Jumlah_studio: " + B.getjumlah_studio());
                        for(int i = 0; i < spasi_id - String.valueOf(B.getjumlah_studio()).length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|Kota: " + B.getkota());
                        for(int i = 0; i < spasi_kota - B.getkota().length(); i++){
                            System.out.print(" ");
                        }
                        System.out.print("|");
                        System.out.println();
                        for(int i = 0; i < spasi_alamat + spasi_kota + spasi_nama + 53; i++){
                        System.out.print("-");
                    }
                        System.out.println();
                    }
                }
            }
            /*
            perintah user untuk mengedit data yang ada di dalam bungkusan
            user diminta memasukan id dari data yang ingin di ubah
            */
            else if("update".equalsIgnoreCase(pilihan)){
                System.out.print("Masukan id bioskop yang mau diubah: ");
                while(!sc.hasNextInt()){
                    System.out.print("Masukan hanya angka: ");
                    sc.next();
                }
                int ubah = sc.nextInt();
                sc.nextLine();
                boolean ketemu = false;
                //perulangan sampai data nya ketemu
                while(ketemu == false && iter.hasNext()){
                    Bioskop B = iter.next();
                    //jika data nya ketemu
                    if(B.getid() == ubah){
                        ketemu = true;
                        //user diminta memasukan dengan memilih angka dari masing masing
                        //data yang ingin di ubah, contoh nya jika user memilih nomor 1, maka nama yang diubah
                        System.out.println("Apa yang mau diubah?");
                        System.out.println("1,Nama");
                        System.out.println("2,Alamat");
                        System.out.println("3,Jumlah Studio");
                        System.out.println("4,Kota");
                        System.out.println("5,Semua (kecuali id)");
                        System.out.print("Masukan nomor: ");
                        while(!sc.hasNextInt()){
                            System.out.print("Masukan hanya angka: ");
                            sc.next();
                        }
                        int update_yang_mana = sc.nextInt();
                        sc.nextLine();
                        //perkondisian masing masing pilihan user (1 sampai 5)
                        if(update_yang_mana == 1){
                            System.out.print("Masukan nama: ");
                            B.setnama(sc.nextLine());
                            System.out.println("Pergantian nama berhasil...");
                        }
                        else if(update_yang_mana == 2){
                            System.out.print("Masukan alamat: ");
                            B.setalamat(sc.nextLine());
                            System.out.println("Pergantian alamat berhasil...");
                        }
                        else if(update_yang_mana == 3){
                            System.out.print("Masukan jumlah studio: ");
                            while(!sc.hasNextInt()){
                                System.out.print("Masukan hanya angka: ");
                                sc.next();
                            }
                            B.setjumlah_studio(sc.nextInt());
                            sc.nextLine();
                            System.out.println("Pergantian jumlah studio berhasil...");
                        }
                        else if(update_yang_mana == 4){
                            System.out.print("Masukan kota: ");
                            B.setkota(sc.nextLine());
                            System.out.println("Pergantian kota berhasil...");
                        }
                        else if(update_yang_mana == 5){
                            System.out.print("Masukan nama: ");
                            B.setnama(sc.nextLine());
                            System.out.print("Masukan alamat: ");
                            B.setalamat(sc.nextLine());
                            System.out.print("Masukan jumlah studio: ");
                            B.setjumlah_studio(sc.nextInt());
                            sc.nextLine();
                            System.out.print("Masukan kota: ");
                            B.setkota(sc.nextLine());
                            System.out.println("Pergantian seluruh data berhasil...");
                        }
                        else{
                            System.out.println("Nomor tidak valid");
                        }
                    }
                }
                //jika data tidak ditemukan
                if(ketemu == false){
                    System.out.println("Kode tidak ditemukan.....");
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
                System.out.println("Update: Untuk mengedit data yang ada");
                System.out.println("Delete: Untuk menghapus data");
                System.out.println("Search: untuk mencari data");
                System.out.println("Exit: Untuk keluar dari program");
                System.out.println("Help: jika lupa apa saja perintah yang ada");
            }
            /*
            perintah ini adalah perintah untuk menghapus data dalam array,
            user diminta memasukan data berupa id dan algoritma akan mencocokan
            data nya ke dalam bungkusan, dan jika data nya ada, maka data akan terhapus
            data yang terhapus adalah semua nya termasuk nama, alamat, jadi berhati hatilah
            */
            else if("delete".equalsIgnoreCase(pilihan)){
                System.out.print("Masukan id bioskop yang mau dihapus: ");
                while(!sc.hasNextInt()){
                    System.out.print("Masukan hanya angka: ");
                    sc.next();
                }
                int hapus = sc.nextInt();
                sc.nextLine();
                boolean ketemu = false;
                while(ketemu == false && iter.hasNext()){
                    Bioskop B = iter.next();
                    if(B.getid() == hapus){
                        iter.remove();
                        System.out.println("Data Berhasil terhapus.... noooooooo");
                        ketemu = true;
                    }
                }
                if(ketemu == false){
                    System.out.println("Data tidak ditemukan (jangan halu)......");
                }
            }
            /*
            perintah ini adalah perintah untuk melakukan pencarian data spesifik
            user diminta memasukan data berupa id dan jika id tersebut ada dalam bungkusan
            atau array list, maka data itu akan muncul dan hanya data itu saja
            */
            else if("search".equalsIgnoreCase(pilihan)){
                System.out.print("Masukan id bioskop yang mau dicari: ");
                while(!sc.hasNextInt()){
                    System.out.print("Masukan hanya angka: ");
                    sc.next();
                }
                int cari = sc.nextInt();
                sc.nextLine();
                boolean ketemu = false;
                while(ketemu == false && iter.hasNext()){
                    Bioskop B = iter.next();
                    if(B.getid() == cari){
                        System.out.println("Id: " + B.getid());
                        System.out.println("Nama: " + B.getnama());
                        System.out.println("Alamat: " + B.getalamat());
                        System.out.println("Jumlah_studio: " + B.getjumlah_studio());
                        System.out.println("Kota: " + B.getkota());
                        ketemu = true;
                    }
                }
                if(ketemu == false){
                    System.out.println("Data tidak ditemukan (jangan halu)......");
                }
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
