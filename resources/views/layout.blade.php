<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tes Package Laravel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-zinc-950 text-white antialiased">
    <main class="mx-auto min-h-screen w-full max-w-6xl px-6 py-10 sm:px-8">
        <nav class="mb-12 flex flex-wrap items-center justify-between gap-4 border-b border-zinc-800 pb-5">
            <a href="{{ route('tes-package.landing') }}" class="text-sm font-semibold text-white">
                Tes Package Laravel
            </a>

            <div class="flex items-center gap-3 text-sm">
                <a href="{{ route('tes-package.landing') }}" class="text-zinc-300 hover:text-white">Landing</a>
                <a href="{{ route('tes-package.notes.index') }}" class="text-emerald-300 hover:text-emerald-100">Notes</a>
            </div>
        </nav>

        @yield('content')
    </main>
</body>
</html>
