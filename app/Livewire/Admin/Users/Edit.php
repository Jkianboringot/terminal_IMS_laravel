<?php

namespace App\Livewire\Admin\Users;
use App\Mail\UserCreatedMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Edit extends Component
{

    public User $user;
    public  $selectedRoles=[];


    function rules(){
            return [
                'user.name'=>'required',
                'user.email'=>'required|unique:users,email,'.$this->user->id,
                'selectedRoles'=>'required',


            ];
    }
    function mount($id){
            $this->user = User::find($id);
            $this->selectedRoles = $this->user->roles()->pluck('id');

    }

    function updated(){
 $this->validate() ; 
    }

    function save(){
  $this->validate();
        try {
             $this->user->update();
            $this->user->roles()->detach();
             $this->user->roles()->attach($this->selectedRoles);
                
             return redirect()->route('admin.users.index');
            } catch (\Throwable $th) {
                $this->dispatch('done',error:'Something went wrong: '.$th->getMessage());
            }
    }
    public function render()
    {
        return view('livewire.admin.users.edit',
    [
        'roles'=>Role::all()
    ]);
    }
}