from os import system

def menu():
    system('cls')
    print("=================== Program Pengurutan ===================")
    print("Pilih Pengurutan Ascending atau Descending")
    print("1. Ascending")
    print("2. Descending")
    print("==========================================================")
def asc(arr):
    arr = arr
    # print(arr)
    print("Diurutkan secara Ascending ")
    n = len(arr)
    for i in range(n):
        # 0
        for j in range(0, n-i-1):
            # print("a " + str(j))
            # 0
            if arr[j] > arr[j+1] :
                arr[j], arr[j+1] = arr[j+1], arr[j]
    for j in range(n):
        print(arr[j])
    print("============================================================")

def desc(arr):
    arr = arr
    print("Diurutkan secara Descending ")
    n = len(arr)
    for i in range(n):
        for j in range(0, n-i-1):
            if arr[j] < arr[j+1] :
                arr[j], arr[j+1] = arr[j+1], arr[j]
    for j in range(n):
        print(arr[j])
    print("============================================================")

if __name__ == '__main__':
    menu()
    choice = int(input("Masukkan pilihan anda <1 atau 2>: "))
    while choice:
        if choice == 1:
            arr = []
            jarr = int(input("Masukkan banyak elemen array = "))
            for a in range(jarr):
                inpus = int(input("Elemen ke - " + str(a+1) + " = "))
                arr.append(inpus)
            asc(arr)
            kembali = input("Kembali ke Menu Utama : pilih [Y/N] ")
            if kembali == "Y" or kembali == "y":
                menu()
                choice = int(input("Masukkan pilihan anda <1 atau 2>: "))
            else:
                exit()
        elif choice == 2:
            arr = []
            jarr = int(input("Masukkan banyak elemen array = "))
            for a in range(jarr):
                inpus = int(input("Elemen ke - " + str(a+1) + " = "))
                arr.append(inpus)
            desc(arr)
            kembali = input("Kembali ke Menu Utama : pilih [Y/N] ")
            if kembali == "Y" or kembali == "y":
                menu()
                choice = int(input("Masukkan pilihan anda <1 atau 2>: "))
            else:
                exit()