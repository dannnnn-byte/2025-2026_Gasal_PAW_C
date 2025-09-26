def menu():
    print("+===========================+")
    print("| Menu |")
    print("|=========================|")
    print("| 1. Buat list sebanyak n |")
    print("| 2. Jumlah data dari list|")
    print("| 3. Rata-rata dari list |")
    print("| 4. Keluar / berhenti |")
    print("+============================+")

def buatlist(n):
    data_list = []
    for i in range(n):
         angka = int(input(f"angka ke-{i+1} = "))
         data_list.append(angka)
    print("data tersimpan =", data_list)
    return data_list

def daftarlist(data_list):
     total = sum(data_list)
     print("Hasil jumlah data list =", total)
     return total

def ratarata(data_list):
    if len(data_list) == 0:
        print("List kosong, tidak bisa dihitung rata-rata.")
        return 0
    rata_rata = sum(data_list) / len(data_list)
    print("Rata-rata data list =", rata_rata)
    return rata_rata

data_list = []
menu()
while True:
    print("===========================================")
    pilihan = int(input("Pilih menu = "))
    if pilihan == 1:
        n = int(input("Banyak data = "))
        data_list = buatlist(n)
    elif pilihan == 2:
        daftarlist(data_list)
    elif pilihan == 3:
        ratarata(data_list)
    elif pilihan == 4:
        print("--- Program akan berhenti ---")
        break
    else:
       print("Pilih yang benar!!!")