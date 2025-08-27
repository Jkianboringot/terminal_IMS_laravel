<?php

namespace App\Livewire\Admin\Units;

use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    public string $search = '';
    public function updatingSearch()
    {
        // Reset pagination when search input changes
        $this->resetPage();
    }
    function delete($id)
    {
        try {
            $unit = Unit::findOrFail($id);
            if (count($unit->products) > 0) {
                throw new \Exception("Error Processing request: This Unit has {$unit->products->count()} product(s)", 1);
            }
            $unit->delete();

            $this->dispatch('done', success: "Successfully Deleted this Unit");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {


        $search = trim($this->search);

        $units = Unit::when(
            $search,
            fn($query) =>
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
        )
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.units.index', [
            'units' => $units
        ]);
    }
}
