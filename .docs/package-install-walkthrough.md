# Walkthrough Install dan Pakai Package

Dokumen ini menjelaskan cara memakai package `driyoagung/tes-package-laravel` di project Laravel lain, sekaligus menjelaskan alur package ini dari sisi kode agar mudah dipelajari.

## Gambaran package ini

Saat package ini di-install ke project Laravel lain, package akan menambahkan:

- route `GET /tes-package`
- controller `Driyoagung\TesPackageLaravel\Http\Controllers\LandingPageController`
- Blade view `tes-package::landing`

Hasil akhirnya: project Laravel tujuan bisa membuka halaman landing page sederhana dari package ini.

## Struktur inti package

File yang paling penting di repo ini:

- [composer.json](/home/agung/www/tes-package/package-repo/composer.json:1)
- [src/TesPackageLaravelServiceProvider.php](/home/agung/www/tes-package/package-repo/src/TesPackageLaravelServiceProvider.php:1)
- [routes/web.php](/home/agung/www/tes-package/package-repo/routes/web.php:1)
- [src/Http/Controllers/LandingPageController.php](/home/agung/www/tes-package/package-repo/src/Http/Controllers/LandingPageController.php:1)
- [resources/views/landing.blade.php](/home/agung/www/tes-package/package-repo/resources/views/landing.blade.php:1)

## Cara kerja package ini

### 1. Composer mengenali package

Di [composer.json](/home/agung/www/tes-package/package-repo/composer.json:1), package ini punya beberapa bagian penting:

```json
{
    "name": "driyoagung/tes-package-laravel",
    "type": "library"
}
```

Artinya repo ini sekarang adalah package Composer biasa, bukan aplikasi Laravel penuh.

Lalu ada autoload PSR-4:

```json
{
    "autoload": {
        "psr-4": {
            "Driyoagung\\TesPackageLaravel\\": "src/"
        }
    }
}
```

Artinya class dengan namespace `Driyoagung\TesPackageLaravel\...` akan dicari di folder `src/`.

### 2. Laravel melakukan auto-discovery service provider

Masih di `composer.json`, ada bagian:

```json
{
    "extra": {
        "laravel": {
            "providers": [
                "Driyoagung\\TesPackageLaravel\\TesPackageLaravelServiceProvider"
            ]
        }
    }
}
```

Bagian ini penting karena setelah package di-install, Laravel akan otomatis membaca provider tersebut tanpa perlu Anda menambahkannya manual ke `config/app.php`.

### 3. Service provider memuat route dan view package

Di [src/TesPackageLaravelServiceProvider.php](/home/agung/www/tes-package/package-repo/src/TesPackageLaravelServiceProvider.php:1):

```php
public function boot(): void
{
    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'tes-package');
}
```

Penjelasannya:

- `loadRoutesFrom(...)` memuat file route milik package
- `loadViewsFrom(..., 'tes-package')` mendaftarkan namespace view `tes-package`

Karena itu nanti controller bisa memanggil view `tes-package::landing`.

### 4. Route package didaftarkan

Di [routes/web.php](/home/agung/www/tes-package/package-repo/routes/web.php:1):

```php
Route::middleware('web')->group(function (): void {
    Route::get('/tes-package', LandingPageController::class)->name('tes-package.landing');
});
```

Penjelasannya:

- route yang dibuat adalah `GET /tes-package`
- route memakai middleware `web`
- route diarahkan ke controller invokable `LandingPageController`
- route name-nya adalah `tes-package.landing`

### 5. Controller merender Blade view

Di [src/Http/Controllers/LandingPageController.php](/home/agung/www/tes-package/package-repo/src/Http/Controllers/LandingPageController.php:1):

```php
public function __invoke()
{
    return view('tes-package::landing');
}
```

Karena controller ini invokable, Laravel langsung memanggil method `__invoke()` saat route `/tes-package` diakses.

### 6. Blade view menampilkan landing page package

Di [resources/views/landing.blade.php](/home/agung/www/tes-package/package-repo/resources/views/landing.blade.php:1), halaman dirender dengan Tailwind CDN. Jadi package ini belum butuh asset build atau publish asset tambahan.

## Step cara pakai di project Laravel lain

Contoh: Anda punya project Laravel lain dan ingin mencoba package ini di sana.

### Step 1. Pastikan repo package ini sudah ter-push ke GitHub

Repo yang dipakai:

```text
git@github.com:driyoagung/tes-package-laravel.git
```

Kalau perubahan package terbaru belum di-push, project lain tidak akan bisa mengambil versi terbarunya.

### Step 2. Buka project Laravel tujuan

Masuk ke folder project Laravel lain yang akan memakai package ini.

Contoh:

```bash
cd /path/ke/project-laravel-lain
```

### Step 3. Tambahkan repository VCS ke `composer.json`

Edit `composer.json` project Laravel tujuan lalu tambahkan:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:driyoagung/tes-package-laravel.git"
        }
    ]
}
```

Kalau project tersebut sudah punya key `repositories`, cukup tambahkan item baru di dalam array itu.

Kalau repo package Anda public dan ingin pakai HTTPS, boleh juga:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/driyoagung/tes-package-laravel.git"
        }
    ]
}
```

### Step 4. Tambahkan package ke `require`

Masih di `composer.json` project tujuan, tambahkan:

```json
{
    "require": {
        "driyoagung/tes-package-laravel": "dev-main"
    }
}
```

Kenapa `dev-main`:

- karena package ini belum dirilis ke Packagist
- belum memakai tag versi seperti `v1.0.0`
- branch yang akan diambil Composer adalah branch `main`

### Step 5. Jalankan Composer

Di folder project Laravel tujuan, jalankan:

```bash
composer update driyoagung/tes-package-laravel
```

Atau kalau package belum pernah di-require sama sekali, bisa juga:

```bash
composer require driyoagung/tes-package-laravel:dev-main
```

Tetap pastikan `repositories` sudah ditambahkan dulu di `composer.json`.

### Step 6. Verifikasi package sudah terbaca

Setelah install selesai, cek beberapa hal berikut.

Cek package ada di folder `vendor`:

```bash
ls vendor/driyoagung
```

Cek route sudah terdaftar:

```bash
php artisan route:list --name=tes-package
```

Kalau berhasil, Anda akan melihat route untuk `/tes-package`.

### Step 7. Buka halaman package di browser

Jalankan project Laravel tujuan seperti biasa, lalu buka:

```text
http://domain-project-anda/tes-package
```

Contoh lokal:

```text
http://127.0.0.1:8000/tes-package
```

atau

```text
http://nama-project.test/tes-package
```

Kalau semua benar, halaman landing page dari package akan muncul.

## Contoh `composer.json` project Laravel tujuan

Berikut contoh bentuk minimalnya:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:driyoagung/tes-package-laravel.git"
        }
    ],
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0",
        "driyoagung/tes-package-laravel": "dev-main"
    }
}
```

## Kalau package di-update

Kalau Anda mengubah isi package ini lalu push lagi ke GitHub, di project Laravel lain jalankan:

```bash
composer update driyoagung/tes-package-laravel
```

Kalau Composer masih memakai cache versi lama, biasanya bisa dibantu dengan:

```bash
composer clear-cache
composer update driyoagung/tes-package-laravel
```

## Catatan penting

- Package ini sekarang masih cocok untuk tahap belajar awal
- Route masih hardcoded ke `/tes-package`
- Belum ada config publish
- Belum ada asset publish
- Belum ada migration, command artisan, facade, atau helper tambahan

Itu justru bagus untuk belajar, karena alurnya masih kecil dan mudah diikuti.

## Urutan singkat yang paling praktis

Kalau ingin versi super singkat, urutannya seperti ini:

1. Push repo package ini ke GitHub.
2. Tambahkan `repositories.vcs` di project Laravel lain.
3. Tambahkan `driyoagung/tes-package-laravel:dev-main` ke `require`.
4. Jalankan `composer update driyoagung/tes-package-laravel`.
5. Buka `/tes-package`.
