<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;

class Edit extends Component
{
       public Role  $role;

    function rules(){
            return [
                'role.title'=>'required',
               


            ];
    }
    function mount($id){
            $this->role =Role::find($id);
    }

    function updated(){
 $this->validate() ; 
    }

    function save(){
  $this->validate();
        try {
     
             $this->role->update();
          
             return redirect()->route('admin.roles.index');
            } catch (\Throwable $th) {
                $this->dispatch('done',error:'Something went wrong: '.$th->getMessage());
            }
    }
    public function render()
    {
        return view('livewire.admin.roles.edit');
    }
}
