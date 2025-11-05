import string

def bersihkan_teks(teks):
    teks_lower = teks.lower()
    TANDA_BACA = string.punctuation
    
    teks_bersih = ""
    for karakter in teks_lower:
        if karakter not in TANDA_BACA:
            teks_bersih = teks_bersih + karakter
            
    return teks_bersih

def hitung_kata(teks_artikel, kata_cari):
    teks_bersih = bersihkan_teks(teks_artikel)
    kata_cari_lower = kata_cari.lower()
    
    daftar_kata = teks_bersih.split()
    
    jumlah = daftar_kata.count(kata_cari_lower)
    print(f"\n--- Hasil Pencarian ---")
    print(f"Kata '{kata_cari}' ditemukan {jumlah} kali dalam artikel.\n")

def ganti_kata(teks_artikel, kata_lama, kata_baru, file_output):
    artikel_baru = teks_artikel.replace(kata_lama, kata_baru)
    
    with open(file_output, 'w', encoding='utf-8') as f:
        f.write(artikel_baru)
    
    print(f"\n--- Hasil Penggantian ('{kata_lama}' -> '{kata_baru}') ---")
    print(f"Hasil penggantian telah disimpan ke: {file_output}\n")

def urutkan_kata(teks_artikel, file_output):
    teks_bersih = bersihkan_teks(teks_artikel)
    
    daftar_kata = teks_bersih.split()
    
    kata_unik = []
    for kata in daftar_kata:
        if kata not in kata_unik:
            kata_unik.append(kata)
    
    kata_unik.sort()
    
    with open(file_output, 'w', encoding='utf-8') as f:
        for kata in kata_unik:
            f.write(kata + '\n')
    
    print("\n--- Hasil Pengurutan Kata (A-Z, Unik) ---")
    print(f"Hasil pengurutan telah disimpan ke: {file_output}\n")

FILE_ARTIKEL = "artikel.txt"
FILE_OUTPUT_GANTI = "hasil_ganti.txt"
FILE_OUTPUT_URUT = "hasil_urut.txt"

print(f"Membaca artikel dari {FILE_ARTIKEL}...")

with open(FILE_ARTIKEL, 'r', encoding='utf-8') as f:
    artikel = f.read()
print("Artikel berhasil dimuat.\n")

while True:
    print("--- Menu Analisis Artikel ---")
    print("1. Hitung Jumlah Kata")
    print("2. Ganti Kata & Simpan ke File")
    print("3. Urutkan Kata Unik & Simpan ke File")
    print("4. Keluar")
    
    pilihan = input("Masukkan pilihan Anda (1/2/3/4): ")
    
    if pilihan == '1':
        kata_cari = input("Masukkan kata yang ingin dihitung: ")
        hitung_kata(artikel, kata_cari)
    
    elif pilihan == '2':
        kata_lama = input("Masukkan kata yang ingin diganti: ")
        kata_baru = input("Masukkan kata penggantinya: ")
        ganti_kata(artikel, kata_lama, kata_baru, FILE_OUTPUT_GANTI)
    
    elif pilihan == '3':
        urutkan_kata(artikel, FILE_OUTPUT_URUT)
    
    elif pilihan == '4':
        print("\nTerima kasih! Program selesai.")
        break 
    
    else:
        print("\nPilihan tidak valid. Silakan masukkan angka 1, 2, 3, atau 4.\n")