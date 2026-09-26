<?php

    class BioskopLuxury extends BioskopPremium{
        private string $nama_restoran;
        private int $jumlah_meja;
        private int $jumlah_reservasi;

        public function __construct($id, $nama, $alamat, $jumlah_studio, $kota, $gambar, $nama_lounge, $kapasitas_lounge, $harga_tiket_premium, $nama_restoran, $jumlah_meja, $jumlah_reservasi){
            parent::__construct($id, $nama, $alamat, $jumlah_studio, $kota, $gambar, $nama_lounge, $kapasitas_lounge, $harga_tiket_premium);
            $this->nama_restoran = $nama_restoran;
            $this->jumlah_meja = $jumlah_meja;
            $this->jumlah_reservasi = $jumlah_reservasi;
        }

        public function getnamarestoran(){
            return $this->nama_restoran;
        }
        
        public function setnamarestoran($nama_restoran){
            $this->nama_restoran = $nama_restoran;
        }

        public function getjumlahmeja(){
            return $this->jumlah_meja;
        }
        
        public function setjumlahmeja($jumlah_meja){
            $this->jumlah_meja = $jumlah_meja;
        }

        public function getjumlahreservasi(){
            return $this->jumlah_reservasi;
        }
        
        public function setjumlahreservasi($jumlah_reservasi){
            $this->jumlah_reservasi = $jumlah_reservasi;
        }

    }

?>