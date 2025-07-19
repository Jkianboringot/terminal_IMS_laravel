<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;

class Index extends Component
{

    function updatePermissions($id){
       try {
         if ($id != 1) {
            throw new \Exception("This is not the Super Admin", 1);
            
        }
        $role= Role::find($id);
        $role->permissions=json_encode(config('permissions.permissions'));
        $role->save();
        $this->dispatch('done',success :'Succesfully Updated Super Admin');
       } catch (\Throwable $th) {
        $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
       }
    }
    
    function delete($id)
    {
        try {
            $role = Role::findOrFail($id);
            if (count($role->users) >0) {
                throw new \Exception("Permission denied: This Role has {$role->users->count()} User", 1);
            }

       
            $role->delete();

            $this->dispatch('done', success: "Successfully Deleted this Role");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.roles.index',[
            'roles'=>Role::all()
        ]);
    }
}
