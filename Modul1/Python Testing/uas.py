import json

class Student:
    def __init__(self, student_id, nama, tahun, alamat, telepon):
        self.id = student_id
        self.nama = nama
        self.tahun = tahun
        self.alamat = alamat
        self.telepon = telepon
        self.krs = []

    def tambah_matkul(self, matkul):
        self.krs.append(matkul)

    def tampil(self): # Menampilkan data lengkap 
        print(f"\nNIM: {self.id}\nNama: {self.nama}\nTahun: {self.tahun}\nAlamat: {self.alamat}\nHP: {self.telepon}")
        for matkul in self.krs:
            print(f"  Mata Kuliah: {matkul.nama}")
            print(f"    Nilai: {matkul.nilai}")
            print(f"    Rata-rata: {matkul.hitung_rata_rata():.2f}")
            for pertemuan, status in matkul.absensi.get(self.nama, {}).items():
                print(f"    {pertemuan}: {status}")

    def to_dict(self): # Mengubah objek Student
        return {
            'id': self.id,
            'nama': self.nama,
            'tahun': self.tahun,
            'alamat': self.alamat,
            'telepon': self.telepon,
            'krs': [matkul.to_dict() for matkul in self.krs]
        }

class Matakuliah:
    def __init__(self, nama, pertemuan):  # membuat objek matakuliah baru.
        self.nama = nama
        self.pertemuan = pertemuan
        self.absensi = {}
        self.nilai = {}

    def set_absen(self, mahasiswa, pertemuan, status): # Menetapkan status kehadiran untuk mahasiswa pada suatu pertemuan.
        if mahasiswa not in self.absensi:
            self.absensi[mahasiswa] = {}
        self.absensi[mahasiswa][pertemuan] = status

    def set_nilai(self, jenis, skor): # Menambahkan atau memperbarui nilai 
        self.nilai[jenis] = skor

    def hitung_rata_rata(self): # Menghitung rata-rata nilai
        if not self.nilai:
            return 0
        return sum(self.nilai.values()) / len(self.nilai) # rata rata

    def to_dict(self): # Mengubah objek Matakuliah 
        return {
            'nama': self.nama,
            'pertemuan': self.pertemuan,
            'absensi': self.absensi,
            'nilai': self.nilai
        }

class AVLNode:
    def __init__(self, student):
        self.student = student
        self.left = None
        self.right = None
        self.height = 1

class AVLTree:
    def __init__(self):
        self.root = None

    def insert(self, root, student):
        if not root:
            return AVLNode(student)
        if student.id < root.student.id:
            root.left = self.insert(root.left, student)
        else:
            root.right = self.insert(root.right, student)

        root.height = 1 + max(self.get_height(root.left), self.get_height(root.right))
        return self.balance(root, student.id)

    def balance(self, node, key):
        balance_factor = self.get_balance(node)
        if balance_factor > 1:
            if key < node.left.student.id:
                return self.rotate_right(node)
            else:
                node.left = self.rotate_left(node.left)
                return self.rotate_right(node)
        if balance_factor < -1:
            if key > node.right.student.id:
                return self.rotate_left(node)
            else:
                node.right = self.rotate_right(node.right)
                return self.rotate_left(node)
        return node

    def get_height(self, node):
        return node.height if node else 0

    def get_balance(self, node):
        return self.get_height(node.left) - self.get_height(node.right) if node else 0

    def rotate_left(self, z):
        y = z.right
        z.right = y.left
        y.left = z
        z.height = 1 + max(self.get_height(z.left), self.get_height(z.right))
        y.height = 1 + max(self.get_height(y.left), self.get_height(y.right))
        return y

    def rotate_right(self, z):
        y = z.left
        z.left = y.right
        y.right = z
        z.height = 1 + max(self.get_height(z.left), self.get_height(z.right))
        y.height = 1 + max(self.get_height(y.left), self.get_height(y.right))
        return y

    def search(self, root, nim):
        if not root:
            return None
        if nim == root.student.id:
            return root.student
        elif nim < root.student.id:
            return self.search(root.left, nim)
        else:
            return self.search(root.right, nim)

    def inorder(self, root):
        if root:
            self.inorder(root.left)
            root.student.tampil()
            self.inorder(root.right)

    def delete(self, root, nim):
        if not root:
            return root
        if nim < root.student.id:
            root.left = self.delete(root.left, nim)
        elif nim > root.student.id:
            root.right = self.delete(root.right, nim)
        else:
            if not root.left:
                return root.right
            elif not root.right:
                return root.left
            temp = self.get_min_value_node(root.right)
            root.student = temp.student
            root.right = self.delete(root.right, temp.student.id)

        root.height = 1 + max(self.get_height(root.left), self.get_height(root.right))
        return self.balance(root, nim)

    def get_min_value_node(self, node):
        current = node
        while current.left:
            current = current.left
        return current

class SistemAkademik: 
    def __init__(self):
        self.avl_tree = AVLTree()
        self.root = None
        self.data = {}

    def simpan_json(self):
        with open("data_mahasiswa.json", "w") as f:
            json.dump({k: v.to_dict() for k, v in self.data.items()}, f, indent=4)

    def load_json(self):
        try:
            with open("data_mahasiswa.json", "r") as f:
                data_json = json.load(f)
                for k, v in data_json.items():
                    mhs = Student(v['id'], v['nama'], v['tahun'], v['alamat'], v['telepon'])
                    for m in v['krs']:
                        mk = Matakuliah(m['nama'], m['pertemuan'])
                        mk.absensi = m['absensi']
                        mk.nilai = m['nilai']
                        mhs.krs.append(mk)
                    self.data[k] = mhs
                    self.root = self.avl_tree.insert(self.root, mhs)
        except FileNotFoundError:
            pass

    def input_mahasiswa(self):
        nim = input("NIM: ")
        nama = input("Nama: ")
        tahun = input("Tahun Masuk: ")
        alamat = input("Alamat: ")
        telepon = input("HP: ")
        mhs = Student(nim, nama, tahun, alamat, telepon)
        self.data[nim] = mhs
        self.root = self.avl_tree.insert(self.root, mhs)
        self.simpan_json()

    def input_matkul(self):
        nim = input("Masukkan NIM: ")
        mhs = self.avl_tree.search(self.root, nim)
        if not mhs:
            print("Mahasiswa tidak ditemukan.")
            return
        nama_mk = input("Nama Mata Kuliah: ")
        jumlah = int(input("Jumlah Pertemuan: "))
        mk = Matakuliah(nama_mk, jumlah)
        for i in range(1, jumlah+1):
            status = input(f"Absen Pertemuan {i} (hadir/tidak hadir/belum): ").lower()
            mk.set_absen(mhs.nama, f"Pertemuan {i}", status)
        n = int(input("Jumlah Penilaian: "))
        for _ in range(n):
            jenis = input("Jenis Penilaian: ")
            skor = int(input("Nilai: "))
            mk.set_nilai(jenis, skor)
        mhs.tambah_matkul(mk)
        self.simpan_json()

    def tampilkan_data(self):
        if not self.root:
            print("Data kosong.")
        else:
            self.avl_tree.inorder(self.root)

    def update_mahasiswa(self):
        nim = input("Masukkan NIM Mahasiswa yang akan diupdate: ")
        mhs = self.avl_tree.search(self.root, nim)
        if not mhs:
            print("Mahasiswa tidak ditemukan.")
            return

        print("\nData Lama:")
        mhs.tampil()

        print("\nMasukkan data baru (tekan Enter untuk melewati):")
        nama_baru = input(f"Nama [{mhs.nama}]: ") or mhs.nama
        tahun_baru = input(f"Tahun [{mhs.tahun}]: ") or mhs.tahun
        alamat_baru = input(f"Alamat [{mhs.alamat}]: ") or mhs.alamat
        telepon_baru = input(f"HP [{mhs.telepon}]: ") or mhs.telepon

        mhs.nama = nama_baru
        mhs.tahun = tahun_baru
        mhs.alamat = alamat_baru
        mhs.telepon = telepon_baru

        print("Data berhasil diperbarui.")
        self.simpan_json()

    def hapus_mahasiswa(self):
        nim = input("NIM Mahasiswa yang ingin dihapus: ")
        if nim in self.data:
            del self.data[nim]
            self.root = self.avl_tree.delete(self.root, nim)
            print("Data dihapus dari sistem dan AVL Tree.")
            self.simpan_json()
        else:
            print("Data tidak ditemukan.")

    def menu(self):
        self.load_json()
        while True:
            print("\n1. Input Mahasiswa")
            print("2. Input Mata Kuliah + Nilai + Absen")
            print("3. Tampilkan Semua Data")
            print("4. Hapus Mahasiswa")
            print("5. Update Mahasiswa")
            print("6. Keluar")

            pilihan = input("Pilih (1-6): ")
            if pilihan == '1':
                self.input_mahasiswa()
            elif pilihan == '2':
                self.input_matkul()
            elif pilihan == '3':
                self.tampilkan_data()
            elif pilihan == '4':
                self.hapus_mahasiswa()
            elif pilihan == '5':
                self.update_mahasiswa()
            elif pilihan == '6':
                break
            else:
                print("Pilihan tidak valid.")

SistemAkademik().menu()
