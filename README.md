# Tes Package Laravel

Package Laravel 12 sederhana untuk belajar membuat package sendiri. Setelah package ini di-install di project Laravel lain, aplikasi tersebut akan mendapat halaman landing page dari package di route `/tes-package`.

Walkthrough lengkap install dan cara pakainya ada di [.docs/package-install-walkthrough.md](/home/agung/www/tes-package/package-repo/.docs/package-install-walkthrough.md:1).

## Isi package

- Service provider: `Driyoagung\TesPackageLaravel\TesPackageLaravelServiceProvider`
- Route package: `/tes-package`
- Controller: `Driyoagung\TesPackageLaravel\Http\Controllers\LandingPageController`
- Blade view: `tes-package::landing`
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

Laravel akan membaca service provider package ini lewat package discovery dari konfigurasi `extra.laravel.providers`.

## Development

Validasi file Composer:

```bash
composer validate --no-check-lock
```

Generate ulang autoload saat menambah class baru:

```bash
composer dump-autoload
```
