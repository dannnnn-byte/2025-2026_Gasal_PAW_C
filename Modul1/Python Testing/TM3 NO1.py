def buatlist(ukuran_list):
     list = []
     for i in range(ukuran_list):
         while True:
            angka = int(input(f"Masukkan angka ke-{i+1}: "))
            if angka not in list:
               list.append(angka)
               break
            else:
             print("Angka tersebut sudah ada dalam list. Masukkan angka lain.")
     return list

def isPrima(angka):
    if angka < 2:
        return False
    for i in range(2, int(angka**0.5) + 1):
        if angka % i == 0:
         return False
    return True

def buatlistprima(list):
    """Fungsi untuk membuat list berisi bilangan prima unik dari list yang diberikan."""
    prima_list = []
    for angka in list:
        if isPrima(angka) and angka not in prima_list:
         prima_list.append(angka)
    return prima_list

data = buatlist(5)
print('data list =', data)

prima = buatlistprima(data)
print('data prima =', prima)