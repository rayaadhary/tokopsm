
## Requirement

- php >= 8.1
- composer
## Installation

Pertama clone repo

```bash
git clone https://github.com/rayaadhary/tokopsm.git
```

masuk ke dalam directory

```bash
cd tokopsm
```

copy file .env.example menjadi .env

```bash
cp .env.example .env
```

install semua vendor

```bash
composer install
```

setelah semua vendor telah terinstall, lakukan pembuatan key

```bash
php artisan key:generate
```

bersihkan semua konfigurasi

```bash
php artisan optimize:clear
```

lakukan pembuatan database, lalu migrate untuk memasukan table dan akun admin

```bash
php artisan migrate --seed
```

jalankan website
```bash
php artisan serve
```

lakukan login dengan username dan password

```bash
adminadmin
password
```
