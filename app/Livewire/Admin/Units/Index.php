<?php

namespace App\Livewire\Admin\Units;

use App\Models\Unit;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
      function delete($id)
    {
        try {
            $unit = Unit::findOrFail(id: $id);
            if (count($unit->products) >0) {
                throw new \Exception("Permission denied: This Unit has {$unit->products->count()} Product", 1);
            }

       
            $unit->delete();

            $this->dispatch('done', success: "Successfully Deleted this unit");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.units.index',[
            "units"=>Unit::paginate(10)
        ]);
    }
}
