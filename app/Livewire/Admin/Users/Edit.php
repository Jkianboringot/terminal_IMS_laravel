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

class Edit extends Component
{
    use WithCancel;

    public User $user;
    public  $selectedRoles = [];


    function rules()
    {
        return [
            'user.name' => 'required',
            'user.email' => 'required|unique:users,email,' . $this->user->id,
            'selectedRoles' => 'required',


        ];
    }
    function mount($id)
    {

        $this->user = User::findOrFail($id);

       
         $currentUser = auth()->user(); //this is an intilisense error no worry
        if (!$currentUser->roles->contains('title', 'Super Administrator')) {
            abort(403, 'Unauthorized');
        }
        
         if ($this->user->roles->contains('title', 'Super Administrator')) {
            abort(403, 'Cant edit other Super Admin');
        }   //ok i forget what ! is for its for reverse logic i will explian it because your forgetting
        // what this block does is to check if teh user as a role title of 'Super Administrator' and with ! it means
        // if the do have have that title then we dont abort because it it will only run teht abort in case the role is not an 
        // admin because it reverse it it say if this role is not and admin than alow edit 
            
        $this->selectedRoles = $this->user->roles()->pluck('id')->toArray();
    }


    function updated()
    {
        $this->validate();
    }
function save()
{
    $this->validate();

    try {
        $this->user->update();

     
        $oldrole= $this->user->roles()->pluck('title')->first();
        $this->user->roles()->detach(); 

        $this->user->roles()->attach($this->selectedRoles);
        $Newrole= $this->user->roles()->pluck('title')->first();

        // Example ActivityLog (adapt fields to your needs)
        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Update',
            'model' => 'User',
            'model_id' => $this->user->id,
            'changes' => json_encode([
                'Old' => $oldrole,
                'New' =>   $Newrole


            ]),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);

        return redirect()->route('admin.users.index');

    } catch (\Throwable $th) {
        $this->dispatch('done', error: 'Something went wrong: ' . $th->getMessage());
    }
}

    public function render()
    {
        return view(
            'livewire.admin.users.edit',
            [
                'roles' => Role::where('title',"!=",'Super Administrator')->get()
            ] // in the future change this to go base on permission like if this titlw role have all permission dont show it not even all jsut a few sensitive one
        );
    }
}

