import os
import math as m


data = dict()
nilaiDisiplin = ""

def menu():
    os.system('cls')
    print("==========MASUKKAN DAFTAR NILAI==========\n")
    data["Nama"] = input("NAMA \t\t\t= ")
    data["Nisn"] = input("NISN \t\t\t= ")
    data["MaPel"] = input("MATA PELAJARAN \t\t= ")
    data["nQuis1"] = input("NILAI QUIS 1 \t\t= ")
    data["nQuis2"] = input("NILAI QUIS 2 \t\t= ")
    data["Tugas"] = input("NILAI TUGAS \t\t= ")
    data["UTS"] = input("NILAI UTS \t\t= ")
    data["UAS"] = input("NLAI UAS \t\t= ")

    print("\n==========HASIL DAFTAR NILAI==========\n")
    print("NAMA \t\t\t= " + data["Nama"])
    print("NISN \t\t\t= " + data["Nisn"])
    print("MATA PELAJARAN \t\t= " + data["MaPel"])

    nqr = m.floor( ((int(data["nQuis1"]) + int(data["nQuis2"]))) / 2 )
    print("RATA-RATA NILAI QUIS \t= " + str(nqr))

    print("NILAI UTS \t\t= " + data["UTS"])
    print("NILAI UAS \t\t= " + data["UAS"])

    nt  = int(data["Tugas"]) # Nilai Tugas
    uts = int(data["UTS"]) # Nilai UTS
    uas = int(data["UAS"]) #Nilai uas

    quiz    = m.floor(nqr*0.20)
    tugas   = m.floor(nt*0.25)
    uts     = m.floor(uts*0.25)
    uas     = m.floor(uas*0.30)
    na      = quiz + tugas + uts + uas
    print("NILAI AKHIR \t\t= " + str(na))

    if na >= 80:
        mutu = "A"
    elif na >= 70 and na < 80:
        mutu = "B"
    elif na >= 60 and na < 70:
        mutu = "C"
    elif na >= 50 and na < 60:
        mutu = "D"
    elif na < 50:
        mutu = "E"

    print("HURUF MUTU \t\t= " + mutu + "\n")

if __name__ == '__main__':
    menu()
    ulang = input("APAKAH INGIN MEGULANG ? (y/n) ")
    while ulang == "y" or ulang == "Y":
        menu()
        ulang = input("APAKAH INGIN MEGULANG ? (y/n) ")
    exit()
