import requests
from bs4 import BeautifulSoup

# URL kategori yang akan di-scrape
url = 'https://www.monotaro.id/c66/c6605.html'

# Melakukan permintaan GET ke URL
response = requests.get(url)

# Mengecek apakah permintaan berhasil
if response.status_code == 200:
    # Membuat objek BeautifulSoup
    soup = BeautifulSoup(response.text, 'html.parser')
    
    # Mencari semua elemen <li> dengan kelas 'item'
    items = soup.find_all('li', class_='item')
    
    # Looping melalui setiap elemen <li> dan mengekstrak informasi yang diperlukan
    for item in items:
        # Mendapatkan teks dari elemen <a>
        link_text = item.a.get_text(strip=True)
        
        # Mendapatkan URL dari atribut href pada elemen <a>
        link_url = item.a['href']
        
        # Mendapatkan jumlah item dari elemen <span> dengan kelas 'count'
        count = item.find('span', class_='count').get_text(strip=True)
        
        # Menampilkan hasil
        print(f"Kategori: {link_text}")
        print(f"URL: {link_url}")
        print(f"Jumlah Item: {count}")
        print()
else:
    print("Gagal melakukan permintaan ke URL.")
