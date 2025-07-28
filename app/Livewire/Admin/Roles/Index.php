<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;

class Index extends Component
{

    // function updatePermissions($id){
    //    try {
    //        $currentUser = auth()->user(); //this is an intilisense error no worry
    //     if (!$currentUser->roles->contains('title', 'Super Administrator')) {
    //         abort(403, 'Only Admin Action');
    //     }
    //     $role= Role::find($id);
    //     $role->permissions=json_encode(config('permissions.permissions'));
    //     $role->save();
    //     $this->dispatch('done',success :'Succesfully Updated Super Admin');
    //    } catch (\Throwable $th) {
    //     $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
    //    }
    // }

    function delete($id)
    {
        try {
            $currentUser = auth()->user(); //this is an intilisense error no worry

            if (!$currentUser->roles->contains('title', 'Super Administrator')) {
                abort(403, 'Only Admin Action');
            }

            $role = Role::findOrFail($id);
            if ($role->users->count() > 0) {
                throw new \Exception("Permission denied: This role has {$role->users->count()} user(s) assigned.");
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
        return view('livewire.admin.roles.index', [
            'roles' => Role::all()
        ]);
    }
}
