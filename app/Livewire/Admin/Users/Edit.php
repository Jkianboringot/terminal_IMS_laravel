<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;

use Livewire\Component;

use Illuminate\Support\Str;

class Edit extends Component
{

    public User $user;

    function rules(){
            return [
                'user.name'=>'required',
                  'user.email' => "required|unique:users,email," . $this->user->id,


            ];
    }
    function mount($id){
            $this->user = User::find($id);
    }

    function updated(){
 $this->validate() ; 
    }

    function save(){
  $this->validate();
        try {
          
             $this->user->update();
            
             return redirect()->route('admin.users.index');
            } catch (\Throwable $th) {
                $this->dispatch('done',error:'Something went wrong: '.$th->getMessage());
            }
    }
    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}