<?php

    class Bioskop{
        private int $id;
        private string $nama;
        private string $alamat;
        private int $jumlah_studio;
        private string $kota;
        private ?string $gambar;
        public function __construct(int $id, string $nama, string $alamat, int $jumlah_studio, string $kota, ?string $gambar = null){
            $this->id = $id;
            $this->nama = $nama;
            $this->alamat = $alamat;
            $this->jumlah_studio = $jumlah_studio;
            $this->kota = $kota;
            $this->gambar = $gambar;
        }
        public function getid(): int{
            return $this->id;
        }
        public function setid(int $id): void{
            $this->id = $id;
        }
        public function getnama(): string{
            return $this->nama;
        }
        public function setnama(string $nama): void{
            $this->nama = $nama;
        }
        public function getalamat(): string{
            return $this->alamat;
        }
        public function setalamat(string $alamat): void{
            $this->alamat = $alamat;
        }
        public function getjumlah_studio(): int{
            return $this->jumlah_studio;
        }
        public function setjumlah_studio(int $jumlah_studio): void{
            $this->jumlah_studio = $jumlah_studio;
        }
        public function getkota(): string{
            return $this->kota;
        }
        public function setkota(string $kota): void{
            $this->kota = $kota;
        }
        public function getgambar(): ?string{
            return $this->gambar;
        }
        public function setgambar(?string $gambar): void{
            $this->gambar = $gambar;
        }
        
    }


?>