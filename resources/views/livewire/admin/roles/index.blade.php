<div>
   <x-slot:head>Roles</x-slot:head>

    
 <div class="card">
    <div class="card-header bg-inv-primary text-inv-secondary border-0">
        <h5>Roles List</h5>
    </div>
     <div class="card-body table-responsive">
    <table class="table table-hover ">
    <thead class="thead-inverse">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>User</th>
            <th class="text-center">Actions</th>

        </tr>
        </thead>
        <tbody>
           @foreach($roles as $role)
 <tr>
                <td scope="row">{{ $role->id  }}</td>
                <td>{{ $role->title }}</td>
                <td>{{ count($role->users) }}</td>
               
                </td>
                <td class="text-center">
                    <a wire:navigate href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn btn-secondary">
                   <i class="bi bi-pencil-square"></i>

                    </a>
                    <a class="btn btn btn-secondary">
                   <i class="bi bi-trash-fill"></i>

                    </a>
                </td>
             
            </tr>   
           @endforeach
           
        </tbody>
  </table>
  </div>
 </div>

</div>
