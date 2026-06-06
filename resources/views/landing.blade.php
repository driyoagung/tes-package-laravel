<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tes Package Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-zinc-950 text-white antialiased">
    <main class="min-h-screen">
        <section class="mx-auto flex min-h-screen w-full max-w-6xl flex-col justify-center px-6 py-16 sm:px-8">
            <div class="max-w-3xl">
                <p class="mb-4 inline-flex border border-emerald-400/40 bg-emerald-400/10 px-3 py-1 text-sm font-medium text-emerald-200">
                    Laravel 12 Package
                </p>

                <h1 class="text-4xl font-semibold tracking-normal text-white sm:text-6xl">
                    Tes Package Laravel
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-zinc-300">
                    Package ini berhasil terpasang dan route dari package sudah aktif di aplikasi Laravel kamu.
                    Halaman ini dirender dari Blade view milik package.
                </p>

                <div class="mt-10 grid gap-4 sm:grid-cols-3">
                    <div class="border border-zinc-800 bg-zinc-900/70 p-5">
                        <p class="text-sm text-zinc-400">Route</p>
                        <p class="mt-2 font-mono text-sm text-emerald-200">/tes-package</p>
                    </div>

                    <div class="border border-zinc-800 bg-zinc-900/70 p-5">
                        <p class="text-sm text-zinc-400">View namespace</p>
                        <p class="mt-2 font-mono text-sm text-sky-200">tes-package::landing</p>
                    </div>

                    <div class="border border-zinc-800 bg-zinc-900/70 p-5">
                        <p class="text-sm text-zinc-400">Provider</p>
                        <p class="mt-2 font-mono text-sm text-amber-200">auto-discovered</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
