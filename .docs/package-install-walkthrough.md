# Walkthrough Install dan Pakai Package

Dokumen ini menjelaskan cara memakai package `driyoagung/tes-package-laravel` di project Laravel lain, sekaligus menjelaskan alur package ini dari sisi kode agar mudah dipelajari.

## Gambaran package ini

Saat package ini di-install ke project Laravel lain, package akan menambahkan:

- route `GET /tes-package`
- route CRUD `/tes-package/notes`
- controller `Driyoagung\TesPackageLaravel\Http\Controllers\LandingPageController`
- controller CRUD `Driyoagung\TesPackageLaravel\Http\Controllers\NoteController`
- model `Driyoagung\TesPackageLaravel\Models\Note`
- migration untuk tabel `tes_package_notes`
- Blade view `tes-package::landing`
- Blade view CRUD `tes-package::notes.*`

Hasil akhirnya: project Laravel tujuan bisa membuka halaman landing page sederhana dan Notes CRUD dari package ini.

## Struktur inti package

File yang paling penting di repo ini:

- [composer.json](../composer.json)
- [src/TesPackageLaravelServiceProvider.php](../src/TesPackageLaravelServiceProvider.php)
- [routes/web.php](../routes/web.php)
- [src/Http/Controllers/LandingPageController.php](../src/Http/Controllers/LandingPageController.php)
- [src/Http/Controllers/NoteController.php](../src/Http/Controllers/NoteController.php)
- [src/Models/Note.php](../src/Models/Note.php)
- [database/migrations/2026_06_06_000000_create_tes_package_notes_table.php](../database/migrations/2026_06_06_000000_create_tes_package_notes_table.php)
- [resources/views/landing.blade.php](../resources/views/landing.blade.php)
- [resources/views/notes/index.blade.php](../resources/views/notes/index.blade.php)

## Cara kerja package ini

### 1. Composer mengenali package

Di [composer.json](../composer.json), package ini punya beberapa bagian penting:

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

Di [src/TesPackageLaravelServiceProvider.php](../src/TesPackageLaravelServiceProvider.php):

```php
public function boot(): void
{
    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'tes-package');
}
```

Penjelasannya:

- `loadMigrationsFrom(...)` memuat migration milik package
- `loadRoutesFrom(...)` memuat file route milik package
- `loadViewsFrom(..., 'tes-package')` mendaftarkan namespace view `tes-package`

Karena itu host app bisa menjalankan migration package, route package bisa aktif, dan controller bisa memanggil view seperti `tes-package::landing` atau `tes-package::notes.index`.

### 4. Route package didaftarkan

Di [routes/web.php](../routes/web.php):

```php
Route::middleware('web')->group(function (): void {
    Route::get('/tes-package', LandingPageController::class)->name('tes-package.landing');
    Route::resource('/tes-package/notes', NoteController::class)
        ->names('tes-package.notes')
        ->except('show');
});
```

Penjelasannya:

- route yang dibuat adalah `GET /tes-package`
- route CRUD dibuat di prefix `/tes-package/notes`
- route memakai middleware `web`
- route diarahkan ke controller invokable `LandingPageController`
- route name-nya adalah `tes-package.landing`
- route CRUD memakai nama seperti `tes-package.notes.index`, `tes-package.notes.store`, dan `tes-package.notes.update`

### 5. Controller merender Blade view

Di [src/Http/Controllers/LandingPageController.php](../src/Http/Controllers/LandingPageController.php):

```php
public function __invoke()
{
    return view('tes-package::landing');
}
```

Karena controller ini invokable, Laravel langsung memanggil method `__invoke()` saat route `/tes-package` diakses.

### 6. Model package terhubung ke tabel package

Di [src/Models/Note.php](../src/Models/Note.php):

```php
class Note extends Model
{
    protected $table = 'tes_package_notes';

    protected $fillable = [
        'title',
        'content',
    ];
}
```

Model ini tetap berada di package, tetapi saat dijalankan dari project host, koneksi database yang dipakai adalah koneksi database milik project host.

### 7. Migration package membuat tabel di database host

Di [database/migrations/2026_06_06_000000_create_tes_package_notes_table.php](../database/migrations/2026_06_06_000000_create_tes_package_notes_table.php), package membuat tabel:

```php
Schema::create('tes_package_notes', function (Blueprint $table): void {
    $table->id();
    $table->string('title');
    $table->text('content')->nullable();
    $table->timestamps();
});
```

File migration ini tidak disalin ke folder `database/migrations` project host. Laravel membacanya dari folder package di `vendor` karena service provider menjalankan `loadMigrationsFrom(...)`.

### 8. Blade view menampilkan landing page dan CRUD package

Di [resources/views/landing.blade.php](../resources/views/landing.blade.php), halaman dirender dengan Tailwind CDN. Jadi package ini belum butuh asset build atau publish asset tambahan.

Untuk CRUD, view berada di folder [resources/views/notes](../resources/views/notes/index.blade.php) dan dipanggil memakai namespace `tes-package::notes.*`.

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

### Step 6. Jalankan migration package

Karena package ini membawa tabel `tes_package_notes`, jalankan:

```bash
php artisan migrate
```

Laravel akan membaca migration dari package melalui service provider:

```php
$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
```

### Step 7. Verifikasi package sudah terbaca

Setelah install selesai, cek beberapa hal berikut.

Cek package ada di folder `vendor`:

```bash
ls vendor/driyoagung
```

Cek route sudah terdaftar:

```bash
php artisan route:list --name=tes-package
```

Kalau berhasil, Anda akan melihat route untuk `/tes-package` dan `/tes-package/notes`.

### Step 8. Buka halaman package di browser

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

Untuk mencoba CRUD:

```text
http://nama-project.test/tes-package/notes
```

Di halaman itu Anda bisa membuat, mengedit, dan menghapus note. Data disimpan ke database project host, tetapi kode model, controller, route, migration, dan view tetap berasal dari package.

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
php artisan migrate
```

Kalau Composer masih memakai cache versi lama, biasanya bisa dibantu dengan:

```bash
composer clear-cache
composer update driyoagung/tes-package-laravel
php artisan migrate
```

Kenapa tetap perlu `php artisan migrate`: kalau update package membawa migration baru, database project host perlu menjalankan migration tersebut. Kalau tidak ada migration baru, Laravel akan menampilkan bahwa tidak ada migration yang perlu dijalankan.

## Catatan penting

- Package ini sekarang sudah membawa runtime Notes CRUD sederhana
- Route masih hardcoded ke `/tes-package`
- Belum ada config publish
- Belum ada asset publish
- Belum ada command artisan, facade, atau helper tambahan

Itu justru bagus untuk belajar, karena alurnya masih kecil dan mudah diikuti.

## Urutan singkat yang paling praktis

Kalau ingin versi super singkat, urutannya seperti ini:

1. Push repo package ini ke GitHub.
2. Tambahkan `repositories.vcs` di project Laravel lain.
3. Tambahkan `driyoagung/tes-package-laravel:dev-main` ke `require`.
4. Jalankan `composer update driyoagung/tes-package-laravel`.
5. Jalankan `php artisan migrate`.
6. Buka `/tes-package`.
7. Buka `/tes-package/notes`.
