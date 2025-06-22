<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class Create extends Component
{
        public Role $role;

    function rules(){
            return [
                'role.title'=>'required',
               


            ];
    }
    function mount(){
            $this->role = new Role();
    }

    function updated(){
 $this->validate() ; 
    }

    function save(){
  $this->validate();
        try {
     
             $this->role->save(); 
                // if this is big letter it does not allow you to save for somereason
                // o becaseu of this which is jsut self or variable sefl its calling $role but with self so that it does not change and be call globally in the class
          
             return redirect()->route('admin.roles.index');
            } catch (\Throwable $th) {
                $this->dispatch('done',error:'Something went wrong: '.$th->getMessage());
            }
    }
    public function render()
    {
        return view('livewire.admin.roles.create');
    }
}
