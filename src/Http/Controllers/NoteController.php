<?php

namespace Driyoagung\TesPackageLaravel\Http\Controllers;

use Driyoagung\TesPackageLaravel\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function index(): View
    {
        return view('tes-package::notes.index', [
            'notes' => Note::query()->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('tes-package::notes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Note::query()->create($this->validatedData($request));

        return redirect()
            ->route('tes-package.notes.index')
            ->with('status', 'Note berhasil dibuat.');
    }

    public function edit(Note $note): View
    {
        return view('tes-package::notes.edit', [
            'note' => $note,
        ]);
    }

    public function update(Request $request, Note $note): RedirectResponse
    {
        $note->update($this->validatedData($request));

        return redirect()
            ->route('tes-package.notes.index')
            ->with('status', 'Note berhasil diperbarui.');
    }

    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();

        return redirect()
            ->route('tes-package.notes.index')
            ->with('status', 'Note berhasil dihapus.');
    }

    /**
     * @return array{title: string, content?: string|null}
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);
    }
}
