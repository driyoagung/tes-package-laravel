# Walkthrough Notes CRUD Package

Dokumen ini fokus pada alur database di package `driyoagung/tes-package-laravel`.

## Tujuan

Package ini sekarang tidak hanya menampilkan landing page, tetapi juga membawa Notes CRUD yang bisa langsung dipakai dari project Laravel lain.

Route utama:

- `/tes-package`
- `/tes-package/notes`
- `/tes-package/notes/create`
- `/tes-package/notes/{note}/edit`

Tabel database:

- `tes_package_notes`

## Alur request CRUD

Saat user membuka:

```text
/tes-package/notes
```

Laravel host app menjalankan route yang berasal dari package:

```php
Route::resource('/tes-package/notes', NoteController::class)
    ->names('tes-package.notes')
    ->except('show');
```

Route ini memanggil `NoteController` dari package, bukan controller dari folder `app/Http/Controllers` host app.

## Alur migration package

Service provider package memuat migration lewat:

```php
$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
```

Saat project host menjalankan:

```bash
php artisan migrate
```

Laravel ikut membaca file migration package dari folder:

```text
vendor/driyoagung/tes-package-laravel/database/migrations
```

Lalu migration membuat tabel:

```text
tes_package_notes
```

Jadi file migration tetap berada di package, tetapi tabelnya dibuat di database milik project host.

## Alur model package

Model package berada di:

```text
src/Models/Note.php
```

Model ini memakai tabel:

```php
protected $table = 'tes_package_notes';
```

Saat controller package menjalankan:

```php
Note::query()->create($data);
```

Data masuk ke database host app, karena package berjalan di dalam aplikasi Laravel host.

## Alur view package

Service provider juga menjalankan:

```php
$this->loadViewsFrom(__DIR__.'/../resources/views', 'tes-package');
```

Karena itu controller bisa memanggil view:

```php
return view('tes-package::notes.index');
```

View tetap berada di package, tetapi dirender oleh Laravel host app.

## Step update di project host

Setelah package ini di-update dan di-push ke GitHub, jalankan ini di project Laravel yang memakai package:

```bash
composer update driyoagung/tes-package-laravel
php artisan migrate
```

Lalu cek route:

```bash
php artisan route:list --name=tes-package
```

Buka:

```text
/tes-package/notes
```

## Bedanya dengan publish/scaffold

Package ini masih memakai pendekatan runtime package:

- route tetap di package
- controller tetap di package
- model tetap di package
- migration tetap di package
- view tetap di package
- database table dibuat di host app

Pendekatan seperti Breeze berbeda. Breeze menyalin banyak file ke project host supaya developer bisa mengedit hasil scaffold-nya langsung di project utama.

Package ini sengaja belum menyalin file ke host app agar alur runtime package lebih mudah dipahami dulu.
