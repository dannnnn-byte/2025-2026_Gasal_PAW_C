# Data Mahasiswa (Nama -> {Mata Kuliah -> Absen})
data_mahasiswa = {
    "Ali": {
        "Matematika": 12,
        "Fisika": 10,
        "Pemrograman": 14
    },
    "Budi": {
        "Matematika": 15,
        "Fisika": 9,
        "Pemrograman": 13
    },
    "Citra": {
        "Matematika": 11,
        "Fisika": 14,
        "Pemrograman": 12
    }
}

# Fungsi untuk menampilkan mata kuliah dan absen berdasarkan nama mahasiswa
def tampilkan_absen(nama):
    if nama in data_mahasiswa:
        print(f"\nMata Kuliah dan Absen untuk {nama}:")
        for mata_kuliah, absen in data_mahasiswa[nama].items():
            print(f"- {mata_kuliah}: {absen} kehadiran")
    else:
        print("Mahasiswa tidak ditemukan!")

# Input nama mahasiswa
nama_mahasiswa = input("Masukkan nama mahasiswa: ")
tampilkan_absen(nama_mahasiswa)