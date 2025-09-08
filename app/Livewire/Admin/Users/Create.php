<?php

namespace App\Livewire\Admin\Users;
use App\Mail\UserCreatedMail;
use App\Models\Role;
use App\Models\User;
use App\Traits\WithCancel;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Create extends Component
{

    use WithCancel;
    public User $user;
    public  $selectedRoles=[];


    function rules(){
            return [
                'user.name'=>'required',
                'user.email'=>'required|unique:users,email',
                'selectedRoles'=>'required',


            ];
    }
    function mount(){
            $this->user = new User();
    }

    function updated(){
 $this->validate() ; 
    }

    function save(){
  $this->validate();
        try {
            $password= Str::random(12   );
            $this->user->password= Hash::make($password);
             $this->user->save();

             $this->user->roles()->attach($this->selectedRoles);
            Mail::to($this->user->email)->send(new UserCreatedMail($this->user,$password));
                // this is to send info to mailtrap to to get password↑ if you dont have it nothing will be send to mailtrap but acc is created
             return redirect()->route('admin.users.index');
            } catch (\Throwable $th) {
                $this->dispatch('done',error:'Something went wrong: '.$th->getMessage());
            }
    }
    public function render()
    {
        return view('livewire.admin.users.create',
    [
        'roles'=>Role::where('title','!=','Super Administrator')->get()    ]);
    }
}