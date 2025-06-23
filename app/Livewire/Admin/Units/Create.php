<?php

namespace App\Livewire\Admin\Units;

use App\Models\Unit;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class Create extends Component
{
        public Unit $unit;

    function rules(){
            return [
                'unit.name'=>'required',
               


            ];
    }
    function mount(){
            $this->unit = new Unit();
    }

    function updated(){
 $this->validate() ; 
    }

    function save(){
  $this->validate();
        try {
     
             $this->unit->save(); 
                // if this is big letter it does not allow you to save for somereason
                // o becaseu of this which is jsut self or variable sefl its calling $unit but with self so that it does not change and be call globally in the class
          
             return redirect()->route('admin.units.index');
            } catch (\Throwable $th) {
                $this->dispatch('done',error:'Something went wrong: '.$th->getMessage());
            }
    }
    public function render()
    {
        return view('livewire.admin.units.create');
    }
}
