<?php

namespace App\Livewire\Admin\Returns;

use App\Models\ReturnItem;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $return = ReturnItem::find($id);
        if ($return) {
            $return->products()->detach();
            $return->delete();
        }
    }

    public function render()
    {
        $returns = ReturnItem::with('products')
            ->where(function ($query) {
                $query->where('reason', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('return_date', 'like', '%' . $this->search . '%')
                      ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.admin.returns.index', compact('returns'));
    }
}
