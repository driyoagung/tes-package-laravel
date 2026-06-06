@extends('tes-package::layout')

@section('title', 'Notes CRUD')

@section('content')
    <section class="flex flex-wrap items-start justify-between gap-6">
        <div>
            <p class="mb-3 inline-flex border border-emerald-400/40 bg-emerald-400/10 px-3 py-1 text-sm font-medium text-emerald-200">
                Database Package Flow
            </p>
            <h1 class="text-4xl font-semibold tracking-normal text-white">Notes CRUD</h1>
            <p class="mt-4 max-w-2xl text-zinc-300">
                Data di halaman ini berasal dari model, migration, controller, route, dan Blade view milik package.
            </p>
        </div>

        <a href="{{ route('tes-package.notes.create') }}" class="border border-emerald-400 bg-emerald-400 px-5 py-3 text-sm font-semibold text-zinc-950 hover:bg-emerald-300">
            Tambah Note
        </a>
    </section>

    @if (session('status'))
        <div class="mt-8 border border-emerald-400/40 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-100">
            {{ session('status') }}
        </div>
    @endif

    <section class="mt-10 overflow-hidden border border-zinc-800 bg-zinc-900/60">
        @forelse ($notes as $note)
            <article class="grid gap-4 border-b border-zinc-800 p-5 last:border-b-0 md:grid-cols-[1fr_auto]">
                <div>
                    <h2 class="text-xl font-semibold text-white">{{ $note->title }}</h2>
                    <p class="mt-3 whitespace-pre-line text-sm leading-6 text-zinc-300">{{ $note->content ?: 'Tidak ada isi catatan.' }}</p>
                    <p class="mt-4 text-xs text-zinc-500">Dibuat {{ $note->created_at->diffForHumans() }}</p>
                </div>

                <div class="flex items-start gap-3">
                    <a href="{{ route('tes-package.notes.edit', $note) }}" class="border border-zinc-700 px-4 py-2 text-sm font-semibold text-zinc-100 hover:border-zinc-500">
                        Edit
                    </a>

                    <form method="POST" action="{{ route('tes-package.notes.destroy', $note) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border border-red-400/60 px-4 py-2 text-sm font-semibold text-red-200 hover:bg-red-400 hover:text-zinc-950">
                            Hapus
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <div class="p-8 text-zinc-300">
                Belum ada note. Buat note pertama untuk memastikan migration dan model package bekerja.
            </div>
        @endforelse
    </section>

    <div class="mt-8">
        {{ $notes->links() }}
    </div>
@endsection
