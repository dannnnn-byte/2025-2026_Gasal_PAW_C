a = int(input("Masukkan bilangan : "))
def fungsi(a):
    if a <= 1:
        return a
    else:
        return a *fungsi(a-1)
    
print(f"faktorial dari {a} adalah {fungsi(a)}")