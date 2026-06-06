<div>
    <label for="title" class="block text-sm font-medium text-zinc-200">Judul</label>
    <input
        id="title"
        name="title"
        type="text"
        value="{{ old('title', $note?->title) }}"
        class="mt-2 w-full border border-zinc-700 bg-zinc-900 px-4 py-3 text-white outline-none focus:border-emerald-400"
        required
    >
    @error('title')
        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="content" class="block text-sm font-medium text-zinc-200">Isi</label>
    <textarea
        id="content"
        name="content"
        rows="8"
        class="mt-2 w-full border border-zinc-700 bg-zinc-900 px-4 py-3 text-white outline-none focus:border-emerald-400"
    >{{ old('content', $note?->content) }}</textarea>
    @error('content')
        <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
    @enderror
</div>
