<?php

namespace Driyoagung\TesPackageLaravel\Tests\Feature;

use Driyoagung\TesPackageLaravel\Models\Note;
use Driyoagung\TesPackageLaravel\Tests\TestCase;

class NoteCrudTest extends TestCase
{
    public function test_notes_index_can_be_rendered(): void
    {
        Note::query()->create([
            'title' => 'Catatan pertama',
            'content' => 'Isi catatan dari package.',
        ]);

        $response = $this->get('/tes-package/notes');

        $response
            ->assertOk()
            ->assertSee('Notes CRUD')
            ->assertSee('Catatan pertama');
    }

    public function test_note_create_and_edit_pages_can_be_rendered(): void
    {
        $note = Note::query()->create([
            'title' => 'Catatan untuk diedit',
            'content' => 'Isi awal.',
        ]);

        $this->get('/tes-package/notes/create')
            ->assertOk()
            ->assertSee('Tambah Note')
            ->assertSee('Simpan Note');

        $this->get("/tes-package/notes/{$note->id}/edit")
            ->assertOk()
            ->assertSee('Edit Note')
            ->assertSee('Catatan untuk diedit');
    }

    public function test_note_can_be_created_updated_and_deleted(): void
    {
        $this->post('/tes-package/notes', [
            'title' => 'Belajar package database',
            'content' => 'Migration dan model berasal dari package.',
        ])->assertRedirect('/tes-package/notes');

        $note = Note::query()->firstOrFail();

        $this->assertSame('Belajar package database', $note->title);

        $this->put("/tes-package/notes/{$note->id}", [
            'title' => 'Update package database',
            'content' => 'CRUD runtime package berhasil.',
        ])->assertRedirect('/tes-package/notes');

        $this->assertDatabaseHas('tes_package_notes', [
            'id' => $note->id,
            'title' => 'Update package database',
        ]);

        $this->delete("/tes-package/notes/{$note->id}")
            ->assertRedirect('/tes-package/notes');

        $this->assertDatabaseMissing('tes_package_notes', [
            'id' => $note->id,
        ]);
    }
}
