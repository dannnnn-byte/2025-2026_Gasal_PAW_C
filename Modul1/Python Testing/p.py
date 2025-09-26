class Mahasiswa:
    def __init__(self, id_mhs, nama, tahun_masuk):
        self.id = id_mhs
        self.nama = nama
        self.tahun_masuk = tahun_masuk
        self.matkul = {}

    def tambah_matkul(self, matkul_list):
        for matkul in matkul_list:
            if matkul not in self.matkul:
                # Input nilai
                while True:
                    try:
                        nilai = int(input(f"Masukkan nilai untuk {matkul}: "))
                        quiz = int(input(f"masukkan nilai quiz {matkul}: "))
                        uts = int(input(f"masukkan nilai uts {matkul}"))
                        if 0 <= nilai <= 100:
                            break
                        else:
                            print("Nilai harus antara 0 - 100.")
                    except ValueError:
                        print("Input nilai tidak valid.")

                # Input jumlah pertemuan
                while True:
                    try:
                        jumlah = int(input(f"Masukkan jumlah pertemuan untuk {matkul}: "))
                        if jumlah > 0:
                            break
                        else:
                            print("Jumlah pertemuan harus lebih dari 0.")
                    except ValueError:
                        print("Input jumlah tidak valid.")

                # Input status absensi
                absensi = []
                for i in range(jumlah):
                    while True:
                        status = input(f"  Pertemuan {i+1} (Hadir/Absen): ").strip().lower()
                        if status in ["hadir", "absen"]:
                            absensi.append(status.capitalize())
                            break
                        else:
                            print("Masukkan hanya 'Hadir' atau 'Absen'.")

                self.matkul[matkul] = {
                    "nilai": nilai,
                    "quiz":quiz,
                    "uts":uts,
                    "absensi": absensi
                    
                }

    def tampilkan_data(self):
        print(f"\nID: {self.id} | Nama: {self.nama} ({self.tahun_masuk})")
        if self.matkul:
            print("Mata Kuliah:")
            for mk, info in self.matkul.items():
                total_hadir = info["absensi"].count("Hadir")
                total_absen = info["absensi"].count("Absen")
                print(f"  - {mk}:")
                print(f"     Nilai: {info['nilai']}")
                print(f"     Absensi: {', '.join(info['absensi'])}")
                print(f"     Total Hadir: {total_hadir}, Total Absen: {total_absen}")
        else:
            print("  (Belum ada mata kuliah)")

data_mahasiswa = []

def tambah_mahasiswa():
    print("\n=== Tambah Mahasiswa Baru ===")
    nama = input("Masukkan nama mahasiswa: ").strip()
    tahun = input("Masukkan tahun masuk: ").strip()
    id_mhs = f"M{len(data_mahasiswa) + 1:03d}"
    mhs_baru = Mahasiswa(id_mhs, nama, tahun)

    # Input mata kuliah
    input_matkul = input("masukkan mata kuliah(pisahkan dengan koma): ").strip()
    matkul_list = [mk.strip() for mk in input_matkul.split(",") if mk.strip()]

    if matkul_list:
        mhs_baru.tambah_matkul(matkul_list)

    data_mahasiswa.append(mhs_baru)
    print("\nMahasiswa berhasil ditambahkan!")

def tampilkan_semua():
    print("\n=== DAFTAR MAHASISWA ===")
    if not data_mahasiswa:
        print("(Tidak ada data)")
    else:
        for mhs in data_mahasiswa:
            mhs.tampilkan_data()

def menu():
    while True:
        print("\n=== MENU ===")
        print("1. Tambah Mahasiswa Baru")
        print("2. Tampilkan Semua Data")
        print("3. Keluar")

        pilihan = input("Pilih 1-3: ").strip()

        if pilihan == "1":
            tambah_mahasiswa()
        elif pilihan == "2":
            tampilkan_semua()
        elif pilihan == "3":
            print("\nProgram selesai.")
            break
        else:
            print("\nPilihan tidak valid!")

menu()
