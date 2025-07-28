<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;


class Index extends Component
{

    function delete($id)
    {
        try {

            $currentUser = auth()->user(); //this is an intilisense error no worry
            if (!$currentUser->roles->contains('title', 'Super Administrator')) {
                abort(403, 'Only Admin Action');
            }
            if ($currentUser->id == $id) {
                throw new \Exception("You cannot delete your own account.");
            }

            $user = User::findOrFail($id);
            if ($user->roles->contains('title', 'Super Administrator')) {
                throw new \Exception("You cannot delete another Super Administrator.");
            }


            $user->roles()->detach();

            $user->delete();

            $this->dispatch('done', success: "Successfully Deleted this User");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.users.index', [
            'users' => User::with('roles')->get(), // change this, it was all prev is if any performace change or unexpected error go here
        ]);
    }
}
