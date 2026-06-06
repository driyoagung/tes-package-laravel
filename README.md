# Tes Package Laravel

Package Laravel 12 sederhana untuk belajar membuat package sendiri. Setelah package ini di-install di project Laravel lain, aplikasi tersebut akan mendapat halaman landing page di route `/tes-package` dan Notes CRUD di route `/tes-package/notes`.

📖 Dokumentasi lengkap: [Package Installation Walkthrough](./.docs/package-install-walkthrough.md)

## Isi package

- Service provider: `Driyoagung\TesPackageLaravel\TesPackageLaravelServiceProvider`
- Route package: `/tes-package`
- Route Notes CRUD: `/tes-package/notes`
- Migration package: `tes_package_notes`
- Model: `Driyoagung\TesPackageLaravel\Models\Note`
- Controller: `Driyoagung\TesPackageLaravel\Http\Controllers\LandingPageController`
- Controller CRUD: `Driyoagung\TesPackageLaravel\Http\Controllers\NoteController`
- Blade view: `tes-package::landing`
- Blade view CRUD: `tes-package::notes.*`
- Styling awal: Tailwind CDN

## Install dari GitHub tanpa Packagist

Tambahkan repository VCS ke `composer.json` project Laravel yang ingin memakai package ini:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:driyoagung/tes-package-laravel.git"
        }
    ],
    "require": {
        "driyoagung/tes-package-laravel": "dev-main"
    }
}
```

Lalu jalankan:

```bash
composer update driyoagung/tes-package-laravel
```

Karena package ini membawa migration, jalankan juga:

```bash
php artisan migrate
```

Alternatif jika ingin memakai HTTPS:

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

Setelah install selesai, buka:

```text
http://nama-project.test/tes-package
```

Untuk mencoba CRUD database dari package, buka:

```text
http://nama-project.test/tes-package/notes
```

Laravel akan membaca service provider package ini lewat package discovery dari konfigurasi `extra.laravel.providers`.
Service provider tersebut memuat route, view, dan migration dari package.

## Update package di project yang sudah pernah install

Kalau package ini sudah dipakai di project Laravel lain, lalu repo package ini di-update dan di-push ke GitHub, jalankan ini di project pemakai:

```bash
composer update driyoagung/tes-package-laravel
php artisan migrate
```

Kalau Composer masih mengambil cache lama:

```bash
composer clear-cache
composer update driyoagung/tes-package-laravel
php artisan migrate
```

## Development

Validasi file Composer:

```bash
composer validate --no-check-lock
```

Generate ulang autoload saat menambah class baru:

```bash
composer dump-autoload
```
