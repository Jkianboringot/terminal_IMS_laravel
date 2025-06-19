<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use PhpParser\Builder\Use_;
use PhpParser\Node\Stmt\TryCatch;

use illuminate\Support\Str;

class Create extends Component
{

    public User $user;

    function rules(){
            return [
                'user.name'=>'required',
                'user.email'=>'required|unique:users,email',


            ];
    }
    function mount(){
            $this->user = new User();
    }

    function updated(){
 $this->validate() ; 
    }

    function save(){
        $this->validate() ; 
        try {
            $password= Str::random(12   );
            $this->user->password= Hash::make($password);
             $this->user->save;

             return redirect()->route('admin.users.index');
            } catch (\Throwable $th) {
                $this->dispatch('done',error:'Something went wrong: '.$th->getMessage());
            }
    }
    public function render()
    {
        return view('livewire.admin.users.create');
    }
}
