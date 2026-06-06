@extends('tes-package::layout')

@section('title', 'Tes Package Laravel')

@section('content')
        <section class="flex min-h-[calc(100vh-10rem)] w-full flex-col justify-center py-16">
            <div class="max-w-3xl">
                <p class="mb-4 inline-flex border border-emerald-400/40 bg-emerald-400/10 px-3 py-1 text-sm font-medium text-emerald-200">
                    Laravel 12 Package
                </p>

                <h1 class="text-4xl font-semibold tracking-normal text-white sm:text-6xl">
                    Tes Package Laravel
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-zinc-300">
                    Package ini berhasil terpasang dan route dari package sudah aktif di aplikasi Laravel kamu.
                    Halaman ini dirender dari Blade view milik package, dan sekarang package ini juga membawa Notes CRUD berbasis database.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('tes-package.notes.index') }}" class="border border-emerald-400 bg-emerald-400 px-5 py-3 text-sm font-semibold text-zinc-950 hover:bg-emerald-300">
                        Buka Notes CRUD
                    </a>

                    <a href="{{ route('tes-package.notes.create') }}" class="border border-zinc-700 px-5 py-3 text-sm font-semibold text-zinc-100 hover:border-zinc-500">
                        Buat Note
                    </a>
                </div>

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
@endsection
