<?php

namespace App\Livewire\Admin\StickyNotes;

use App\Models\StickyNote;
use Livewire\Component;

class StickyNoteBanner extends Component
{
    public $content;
    public $noteCount;
    public $editing = false;
    public $editNoteId = null;
    public $notes = [];

    public function mount()
    {
        $latest = StickyNote::latest()->first();
        $this->content = $latest?->content ?? '';
        $this->noteCount = StickyNote::count();
    }

    public function edit($id)
    {
        $note = StickyNote::findOrFail($id);
        $this->editNoteId = $note->id;
        $this->content = $note->content;
        $this->editing = true;
    }

       public function addNote()
    {
        $this->resetForm();     
    $this->editing = true;
    }

    public function deleteNote($id)
    {
        StickyNote::findOrFail($id)->delete();
        $this->refreshNotes();
    }

    public function deleteAllNote()
    {
        StickyNote::truncate();
        $this->resetForm();
        $this->noteCount = 0;
    }

    private function resetForm()
    {
        $this->content = '';
        $this->editNoteId = null;
        $this->editing = false;
        $this->refreshNotes();
    }

    private function refreshNotes()
    {
        $this->notes = StickyNote::latest()->get();
        $this->noteCount = $this->notes->count();
    }


    
    public function save()
    {
             $this->validate(
        [
            'content' => 'required|string|min:5',
        ],
        [
            'content.required' => 'Note cannot be empty.',
            'content.min' => 'Note must be at least 5 characters.',
        ]
    );
        if ($this->editing && $this->editNoteId) {
            // Update existing note
            $note = StickyNote::findOrFail($this->editNoteId);
            $note->update([
                'content' => $this->content,
            ]);
        } else {
            // Create new note
            StickyNote::create([
                'content' => $this->content,
            ]);
        }

        $this->resetForm();
    }

    public function render()
    {
        $this->refreshNotes();

        return view('components.sticky-note-banner', [
            'notes' => $this->notes,
            'editing' => $this->editing,
            'noteCount' => $this->noteCount,
        ]);
    }
}
