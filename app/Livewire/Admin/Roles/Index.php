<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;

class Index extends Component
{
    
    function delete($id)
    {
        try {
            $role = Role::findOrFail($id);
            if (count($role->users) >0) {
                throw new \Exception("Permission denied: This Role has {$role->users->count()} User", 1);
            }

       
            $role->delete();

            $this->dispatch('done', success: "Successfully Deleted this user");
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
