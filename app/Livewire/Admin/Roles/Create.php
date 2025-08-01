<?php

namespace App\Livewire\Admin\Roles;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class Create extends Component
{
    public Role $role;
    public string $search = "";
    public array $permissions = [];

    public array $selected_permissions = [];


    function rules()
    {
        return [
            'role.title' => 'required|unique',



        ];
    }
    function mount()
    {
        $this->role = new Role();
        $this->permissions = config('permissions.permissions');
    }
    function addToList($permission)
    {
      try {
          if (in_array($permission, $this->selected_permissions)) {
            throw new \Exception("Error Processing: Permissions already Added", 1);
        };
        array_push( $this->selected_permissions,$permission);
     
      } catch (\Throwable $th) {
          $this->dispatch('done', error: 'Something went wrong: ' . $th->getMessage());
      }
    }
    function subtractFromList($key)
    {
        try {
            array_splice($this->selected_permissions,$key,1);
        } catch (\Throwable $th) {
              $this->dispatch('done', error: 'Something went wrong: ' . $th->getMessage());
        }

    }

    function updated()
    {
        $this->validate();
    }

    function save()
    {
        $this->validate();
        try {
            $this->role->permissions=json_encode($this->selected_permissions);
            
            $this->role->save();
            // if this is big letter it does not allow you to save for somereason
            // o becaseu of this which is jsut self or variable sefl its calling $role but with self so that it does not change and be call globally in the class
            $this->dispatch('role-created', message: 'Role created successfully!');
            // if somehting go wrong git ri of dispatch
            return redirect()->route('admin.roles.index');
        } catch (\Throwable $th) {
            $this->dispatch('done', error: 'Something went wrong: ' . $th->getMessage());
        }
    }
    public function render()
    {
        $filteredData = [];

        if (!empty($this->search)) {

            $filteredData = array_filter($this->permissions, function ($permission) {
                return str_contains($permission, $this->search) !== false;
            });
        }


        return view('livewire.admin.roles.create', [
            'filtered_permissions' => $filteredData
        ]);
    }
}
