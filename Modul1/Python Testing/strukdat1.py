class Siswa:
    def __init__(self, nama, alamat, hp, nim):
        self.nama = nama
        self.alamat = alamat
        self.hp = hp
        self.nim = nim
        self.absensi = {}

    def tampilkan_identitas(self):
        print(f"\nIdentitas siswa:")
        print(f"Nama   : {self.nama}")
        print(f"Alamat : {self.alamat}")
        print(f"HP     : {self.hp}")
        print(f"NIM    : {self.nim}")

    def tampilkan_matkul(self):
        print(f"\nMata kuliah yang tersedia untuk {self.nama}:")
        for matkul in self.absensi:
            print(f"- {matkul}")

    def cek_absen(self):
        matkul = input("Pilih mata kuliah yang ingin dicek absen (sebutkan nama matkul): ").capitalize()
        if matkul in self.absensi:
            pertemuan = input("Pilih pertemuan yang ingin dicek absen (contoh: Pertemuan 1): ").capitalize()
            if pertemuan in self.absensi[matkul]:
                absen = self.absensi[matkul][pertemuan]["Absen"]
                if absen is True:
                    print(f"{self.nama} sudah hadir di mata kuliah {matkul} ({pertemuan}).")
                elif absen is False:
                    print(f"{self.nama} tidak hadir di mata kuliah {matkul} ({pertemuan}).")
                else:
                    print(f"{self.nama} belum hadir di mata kuliah {matkul} ({pertemuan}).")
            else:
                print(f"{pertemuan} tidak ditemukan.")
        else:
            print(f"Mata kuliah {matkul} tidak ditemukan.")

data = {
    "Burhan": {
        "nama": 'Burhan',
        "alamat": 'Blega',
        "hp": "08123456789",
        "NIM": "240411100170",
    },
    "Akmal": {
        "nama": 'Akmal',
        "alamat": 'Blega',
        "hp": "08123456781",
        "NIM": "240411100171",
    },
    "Farhan": {
        "nama": 'Farhan',
        "alamat": 'Blega',
        "hp": "08123456780",
        "NIM": "240411100172",
    }
}

data_siswa = {
    "Burhan": {
        "Strukdat": {
            "Pertemuan 1": {"Absen": True},
            "Pertemuan 2": {"Absen": True},
            "Pertemuan 3": {"Absen": False},
            "Pertemuan 4": {"Absen": False},
            "Pertemuan 5": {"Absen": "belum"},
        },
        "Dpw": {
            "Pertemuan 1": {"Absen": True},
            "Pertemuan 2": {"Absen": True},
            "Pertemuan 3": {"Absen": False},
            "Pertemuan 4": {"Absen": False},
            "Pertemuan 5": {"Absen": "belum"},
        },
        "Kwn": {
            "Pertemuan 1": {"Absen": True},
            "Pertemuan 2": {"Absen": True},
            "Pertemuan 3": {"Absen": True},
            "Pertemuan 4": {"Absen": False},
            "Pertemuan 5": {"Absen": "belum"},
        }
    },
    "Akmal": {
        "Strukdat": {
            "Pertemuan 1": {"Absen": True},
            "Pertemuan 2": {"Absen": True},
            "Pertemuan 3": {"Absen": False},
            "Pertemuan 4": {"Absen": False},
            "Pertemuan 5": {"Absen": "belum"},
        },
        "Dpw": {
            "Pertemuan 1": {"Absen": True},
            "Pertemuan 2": {"Absen": True},
            "Pertemuan 3": {"Absen": False},
            "Pertemuan 4": {"Absen": False},
            "Pertemuan 5": {"Absen": "belum"},
        },
        "Kwn": {
            "Pertemuan 1": {"Absen": True},
            "Pertemuan 2": {"Absen": True},
            "Pertemuan 3": {"Absen": True},
            "Pertemuan 4": {"Absen": False},
            "Pertemuan 5": {"Absen": "belum"},
        }
    },
    "Farhan": {
        "Strukdat": {
            "Pertemuan 1": {"Absen": True},
            "Pertemuan 2": {"Absen": True},
            "Pertemuan 3": {"Absen": False},
            "Pertemuan 4": {"Absen": False},
            "Pertemuan 5": {"Absen": "belum"},
        },
        "Dpw": {
            "Pertemuan 1": {"Absen": True},
            "Pertemuan 2": {"Absen": True},
            "Pertemuan 3": {"Absen": False},
            "Pertemuan 4": {"Absen": False},
            "Pertemuan 5": {"Absen": "belum"},
        },
        "Kwn": {
            "Pertemuan 1": {"Absen": True},
            "Pertemuan 2": {"Absen": True},
            "Pertemuan 3": {"Absen": True},
            "Pertemuan 4": {"Absen": False},
            "Pertemuan 5": {"Absen": "belum"},
        }
    }
}



def cek_absen(nama):
    matkul = input("Pilih mata kuliah yang ingin dicek absen (sebutkan nama matkul): ").capitalize()
    if matkul in data_siswa[nama]:
        pertemuan = input("Pilih pertemuan yang ingin dicek absen (contoh: Pertemuan 1): ").capitalize()
        if pertemuan in data_siswa[nama][matkul]:
            absen = data_siswa[nama][matkul][pertemuan]["Absen"]
            if absen is True:
                print(f"{nama} sudah hadir di mata kuliah {matkul} ({pertemuan}).")
            elif absen is False:
                print(f"{nama} tidak hadir di mata kuliah {matkul} ({pertemuan}).")
            else:
                print(f"{nama} belum hadir di mata kuliah {matkul} ({pertemuan}).")
        else:
            print(f"{pertemuan} tidak ditemukan.")
    else:
        print(f"Mata kuliah {matkul} tidak ditemukan.")

while True:
    print("\n=== Cek Status Absen Siswa ===")
    nama_siswa = input("Masukkan nama siswa (atau ketik 'exit' untuk keluar): ").capitalize()

    if nama_siswa.lower() == "exit":
        print("Terima kasih! Program selesai.")
        break

    if nama_siswa in data_siswa:
        print(f"\nIdentitas siswa:")
        print(f"Nama   : {data[nama_siswa]['nama']}")
        print(f"Alamat : {data[nama_siswa]['alamat']}")
        print(f"HP     : {data[nama_siswa]['hp']}")
        print(f"NIM    : {data[nama_siswa]['NIM']}")

        print(f"\nMata kuliah yang tersedia untuk {nama_siswa}:")
        for matkul in data_siswa[nama_siswa]:
            print(f"- {matkul}")
        
        cek_absen(nama_siswa)
    else:
        print(f"Nama '{nama_siswa}' tidak ditemukan. Silakan coba lagi.")
         
        data [nama_siswa]= {
            "nama": 'Adi',
            "alamat":'jakarta',
            "hp": '081233',
            "NIM":'245044 '
        }
        print(data)  
        

