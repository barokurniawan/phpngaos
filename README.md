# phpngaos
Online OCR dengan PHP

## Requirement 
- PHP7.4

## Instalasi 
### Menggunakan Docker
Cukup dengan menjalankan perintah `docker-compose up`

### Tanpa docker
Jika tidak menggunakan docker, misal dengan xampp maka di komputer, laptop atau server kalian sudah terinstall tesseract-ocr. 
#### Install tesseract-ocr di linux
`sudo apt-get install tesseract-ocr`

#### Install tesseract-ocr di windows
Ada banyak cara untuk menginstal Tesseract OCR di Windows, tetapi jika Anda hanya ingin sesuatu yang cepat untuk dijalankan, 
saya sarankan menginstal paket Capture2Text dengan [Chocolatey](https://chocolatey.org/).
```
choco install capture2text --version 3.9
```

#### Untuk pengguna macOS
Dengan [MacPorts](https://www.macports.org/) Anda dapat menginstal dukungan untuk bahasa individu, seperti:
```
sudo port install tesseract-<langcode>
```

Tapi itu tidak mungkin dengan Homebrew. Itu hanya datang dengan dukungan bahasa Inggris secara default, jadi jika Anda berniat menggunakannya untuk bahasa lain, solusi tercepat adalah menginstal semuanya:
```
brew install tesseract --with-all-languages
```

#### Install Dependency
Untuk menginstall vendor atau dependency install [composer](https://getcomposer.org/download/) terlebih dahulu.
kemudia buka command line atau cmd, masuk ke root project dan ketikan : 
```
composer install
```
