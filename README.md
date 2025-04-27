<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Aplikasi CRUD To Do List
Ini merupakan aplikasi To Do List dengan fitur Login, Register, dan CRUD

## Langkah Instalasi
- Clone repository https://github.com/agungwahyu23/toDoList.git ke direktori local
- Install Composer dengan composer install
- Install NPM dengan npm install
- Buat database baru
- Buat File .env dan sesuaikan nama database
- Generate key dengan php artisan key:generate
- Lakukan migrasi php artisan migrate
- Jalankan seed dengan php artisan db:seed atau php artisan db:seed --class=UserSeeder
- Build frontend dengan npm run dev

## Projek ini dibuat dengan menggunakan
- laravel 10
- vue js
- mySql

## Struktur Folder
project-name/
│
├── app/                      # Folder untuk kode aplikasi Laravel (backend)
│   ├── Console/
│   ├── Exceptions/
│   ├── Http/
│   ├── Models/
│   ├── Providers/
│   └── ...
│
├── bootstrap/                 # Folder untuk file bootstrap Laravel
│   └── app.php
│
├── config/                    # Folder untuk konfigurasi aplikasi Laravel
│
├── database/                  # Folder untuk migration, seeder, dan factory
│   ├── factories/
│   ├── migrations/
│   ├── seeders/
│   │   └── UserSeeder.php      # Seeder untuk user
│   └── ...
│
├── node_modules/              # Folder dependencies Node.js (frontend)
│
├── public/                    
│   └── index.php              # Entry point untuk aplikasi Laravel
│
├── resources/                 # Folder untuk file sumber daya (views, assets, dll)
├── |── css/
│   ├── js/                    # Folder untuk Vue 3 components dan assets frontend
│   │   ├── components/        # Folder untuk komponen Vue 3
│   │   ├── pages/
│   │   ├── router/
│   │   ├── app.js
│   │   ├── App.vue            # File utama untuk Vue
│   │   └── ...
│   └── views/                 # Folder untuk Blade views (untuk halaman Laravel)
│       ├── welcome.blade.php  # Contoh view untuk halaman utama Laravel
│       └── ...
│
├── routes/                    # Folder untuk file routing Laravel
│   └── web.php                # Routing aplikasi untuk halaman web
│   └── api.php                # Routing aplikasi untuk api
│
├── storage/                   # Folder untuk menyimpan file yang diupload, cache, dll
│
├── tests/                     # Folder untuk testing Laravel
│
├── .env                       # File konfigurasi environment (database, API, dll)
├── .gitignore                 # File untuk mengabaikan file/folder tertentu dari git
├── composer.json              # File konfigurasi untuk Composer
├── composer.lock              # File yang dibuat oleh Composer untuk dependency lock
├── package.json               # File konfigurasi untuk npm (dependencies frontend)
├── package-lock.json          # File lock untuk npm dependencies
├── phpunit.xml                # File konfigurasi untuk PHPUnit testing
└── vite.config.js             # File konfigurasi untuk Vite (bundler frontend)
