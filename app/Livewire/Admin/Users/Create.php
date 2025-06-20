<?php

namespace App\Livewire\Admin\Users;

use App\Mail\UserCreatedMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Create extends Component
{
    public User $user;
    public $selectedRoles = [];

    function rules()
    {
        return [
            'user.name' => "required",
            'selectedRoles' => "required",
            'user.email' => "required|unique:users,email",
        ];
    }

    function mount()
    {
        $this->user = new User();
    }

    function updated()
    {
        $this->validate();
    }
function save()
{
 

    try {
        $this->dispatch('done', message: "step 1: starting");

        $password = Str::random(12);
        $this->dispatch('done', message: "step 2: password generated");

        $this->user->password = Hash::make($password);
        $this->dispatch('done', message: "step 3: password hashed");

        $this->user->save();
        $this->dispatch('done', message: "step 4: user saved");

        $this->user->roles()->attach($this->selectedRoles);
        $this->dispatch('done', message: "step 5: roles attached");

        Mail::to($this->user->email)->send(new \App\Mail\UserCreatedMail($this->user, $password));
        $this->dispatch('done', message: "step 6: mail sent");

        return redirect()->route('admin.users.index');
    } catch (\Throwable $th) {
        $this->dispatch('done', error: "ERROR: " . $th->getMessage());
    }
}




}

// this is correct