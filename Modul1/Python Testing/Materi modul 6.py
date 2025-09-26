# Fungsi tanpa return value
def func1(a,b):
    c = a+b
    print(c) # Menyimpan proses

func1(4,3)

# Fungsi dengan return value
def func1(a,b):
    c = a+b
    return c

hasil=func1(4,3)
print(hasil)

# contoh ke2
def func2(c,d):
    return c*d
func2(hasil,9)

# Fungsi Rekursif
def pangkat(num,pow):
    if pow == 1: # memanggil dirinya sendiri/sebagai batas
        return num
    else:
        return num*pangkat(num,pow-1) 
    
pangkat(2,3)    

# Sigma
x = [5,6,9,81]
n = len(x)-1
def sigma (lst,lenlst):
    if lenlst == 0:
        return lst[lenlst]
    else:
        return lst[lenlst]+sigma(lst,lenlst-1)

sigma(x,n)   