from Bioskop import Bioskop

class BioskopPremium(Bioskop) :
    def __init__(self, id, nama, alamat, jumlah_studio, kota, nama_lounge, kapasitas_lounge, harga_tiket_premium):
        super().__init__(id, nama, alamat, jumlah_studio, kota)
        self.__nama_lounge = nama_lounge
        self.__kapasitas_lounge = kapasitas_lounge
        self.__harga_tiket_premium = harga_tiket_premium

    def getnamalounge(self):
        return self.__nama_lounge
    
    def setnamalounge(self, nama_lounge):
        self.__nama_lounge = nama_lounge

    def getkapasitaslounge(self):
        return self.__kapasitas_lounge
    
    def setkapasitaslounge(self, kapasitas_lounge):
        self.__kapasitas_lounge = kapasitas_lounge

    def gethargatiketpremium(self):
        return self.__harga_tiket_premium
    
    def sethargatiketpremium(self, harga_tiket_premium):
        self.__harga_tiket_premium = harga_tiket_premium
    
        
