class Bioskop:

    # sebuah konstruktor yang menerima masukan berupa id
    # nama, alamat, jumlah studio dan kota
    def __init__(self, id:int, nama:str, alamat:str, jumlah_studio:int, kota:str):
        self.__id = int(id)
        self.__nama = str(nama)
        self.__alamat = str(alamat)
        self.__jumlah_studio = int(jumlah_studio)
        self.__kota = str(kota)
    #Berbagai method get set
    #Get adalah method untuk mengabil data dari sebuah class
    #set adalah method untuk mengedit atau menambahkan data dari sebuah class
    def getid(self) -> int:
        return self.__id

    def setid(self, id:int) -> None:
        self.__id = int(id)

    def getnama(self) -> str:
        return self.__nama

    def setnama(self, nama:str) -> None:
        self.__nama = str(nama)

    def getalamat(self) -> str:
        return self.__alamat

    def setalamat(self, alamat:str) -> None:
        self.__alamat = str(alamat)

    def getjumlah_studio(self) -> int:
        return self.__jumlah_studio

    def setjumlah_studio(self, jumlah_studio:int) -> None:
        self.__jumlah_studio = int(jumlah_studio)

    def getkota(self) -> str:
        return self.__kota

    def setkota(self, kota:str) -> None:
        self.__kota = str(kota)

    