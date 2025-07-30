<?php

namespace App\Http\Livewire;

use App\Models\StickyNote;
use Livewire\Component;

class StickyNoteBanner extends Component
{
    public $content;
    public $editing = false;

    public function mount()
    {
        $note = StickyNote::first();
        $this->content = $note?->content ?? '';
    }

    public function edit()
    {
        $this->editing = true;
    }

    public function save()
    {
        StickyNote::updateOrCreate(['id' => 1], [
            'content' => $this->content,
        ]);
        $this->editing = false;
    }

    public function deleteNote()
    {
        StickyNote::truncate();
        $this->content = '';
        $this->editing = false;
    }

    public function render()
    {
        return view('views.navigation-menu');
    }
}
