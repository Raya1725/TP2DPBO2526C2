from BioskopPremium import BioskopPremium

class BioskopLuxury(BioskopPremium) :
    def __init__(self, id, nama, alamat, jumlah_studio, kota, nama_lounge, kapasitas_lounge, harga_tiket_premium, nama_restoran, jumlah_meja, jumlah_reservasi):
        super().__init__(id, nama, alamat, jumlah_studio, kota, nama_lounge, kapasitas_lounge, harga_tiket_premium)
        self.__nama_restoran = nama_restoran
        self.__jumlah_meja = jumlah_meja
        self.__jumlah_reservasi = jumlah_reservasi

    def getnamarestoran(self):
        return self.__nama_restoran

    def setnamarestoran(self, nama_restoran):
        self.__nama_restoran = nama_restoran

    def getjumlahmeja(self):
        return self.__jumlah_meja

    def setjumlahmeja(self, jumlah_meja):
        self.__jumlah_meja = jumlah_meja

    def getjumlahreservasi(self):
        return self.__jumlah_reservasi

    def setjumlahreservasi(self, jumlah_reservasi):
        self.__jumlah_reservasi = jumlah_reservasi

    