<?php

namespace App\Livewire\Admin\Units;

use App\Models\Unit;
use Livewire\Component;

class Edit extends Component
{
      public Unit  $unit;

    function rules(){
            return [
                'unit.name'=>'required',
               


            ];
    }
    function mount($id){
            $this->unit =Unit::find($id);
    }

    function updated(){
 $this->validate() ; 
    }

    function save(){
  $this->validate();
        try {
     
             $this->unit->update();
          
             return redirect()->route('admin.units.index');
            } catch (\Throwable $th) {
                $this->dispatch('done',error:'Something went wrong: '.$th->getMessage());
            }
    } 
       public function render()
    {
        return view('livewire.admin.units.edit');
    }
}
