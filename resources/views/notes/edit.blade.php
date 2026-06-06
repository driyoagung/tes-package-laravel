@extends('tes-package::layout')

@section('title', 'Edit Note')

@section('content')
    <section class="max-w-3xl">
        <p class="mb-3 inline-flex border border-amber-400/40 bg-amber-400/10 px-3 py-1 text-sm font-medium text-amber-200">
            Update
        </p>
        <h1 class="text-4xl font-semibold tracking-normal text-white">Edit Note</h1>
        <p class="mt-4 text-zinc-300">Perubahan akan diproses oleh controller package lalu disimpan kembali lewat model package.</p>
    </section>

    <form method="POST" action="{{ route('tes-package.notes.update', $note) }}" class="mt-10 max-w-3xl space-y-6">
        @csrf
        @method('PUT')

        @include('tes-package::notes.partials.form', ['note' => $note])

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="border border-emerald-400 bg-emerald-400 px-5 py-3 text-sm font-semibold text-zinc-950 hover:bg-emerald-300">
                Update Note
            </button>

            <a href="{{ route('tes-package.notes.index') }}" class="border border-zinc-700 px-5 py-3 text-sm font-semibold text-zinc-100 hover:border-zinc-500">
                Batal
            </a>
        </div>
    </form>
@endsection
