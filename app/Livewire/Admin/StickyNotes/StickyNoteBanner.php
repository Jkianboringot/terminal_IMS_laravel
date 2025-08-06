<?php

namespace App\Livewire\Admin\StickyNotes;

use App\Models\StickyNote;
use Livewire\Component;

class StickyNoteBanner extends Component
{
    public $content;
    public $noteCount;
    public $editing = false;

 public function mount()
{
    $latest = StickyNote::latest()->first();
    $this->content = $latest?->content ?? '';
    $this->noteCount = StickyNote::count();
}

    public function edit()
    {
        $this->editing = true;
    }

public function save()
{
    StickyNote::create([
        'content' => $this->content,
    ]);

    $this->noteCount = StickyNote::count();
    $this->editing = false;
    $this->content = ''; // optional: clear textarea after saving
}



    public function deleteNote()
    {
        StickyNote::truncate();

        $this->content = '';
        $this->noteCount = 0;
        $this->editing = false;
    }

public $notes = [];

public function render()
{
    $this->notes = StickyNote::latest()->get();
    $this->noteCount = $this->notes->count();

    return view('components.sticky-note-banner', [
        'notes' => $this->notes,
        'editing' => $this->editing,
        'noteCount' => $this->noteCount,
    ]);
}


}
