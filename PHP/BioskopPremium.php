<?php

    class BioskopPremium extends Bioskop{
        private $nama_lounge;
        private $kapasitas_lounge;
        private $harga_tiket_premium;
        
        public function __construct($id, $nama, $alamat, $jumlah_studio, $kota, $gambar, $nama_lounge, $kapasitas_lounge, $harga_tiket_premium){
            parent::__construct($id, $nama, $alamat, $jumlah_studio, $kota, $gambar);
            $this->nama_lounge = $nama_lounge;
            $this->kapasitas_lounge = $kapasitas_lounge;
            $this->harga_tiket_premium = $harga_tiket_premium;
            
        }
            
        public function getnamalounge(){
            return $this->nama_lounge;
        }
        
        public function setnamalounge($nama_lounge){
            $this->nama_lounge = $nama_lounge;
        }

        public function getkapasitas(){
            return $this->kapasitas_lounge;
        }
        
        public function setkapasitaslounge($kapasitas_lounge){
            $this->kapasitas_lounge = $kapasitas_lounge;
        }

        public function gethargatiketpremium(){
            return $this->harga_tiket_premium;
        }
        
        public function sethargatiketpremium($harga_tiket_premium){
            $this->harga_tiket_premium = $harga_tiket_premium;
        }

    }
?>