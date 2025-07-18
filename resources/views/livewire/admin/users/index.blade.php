<div>
   <x-slot:head>Users</x-slot:head>
 @php
    $user = auth()->user();
    @endphp
    
 <div class="card">
    <div class="card-header bg-inv-primary text-inv-secondary border-0">
        <h5>Users List</h5>
    </div>
     <div class="card-body table-responsive">
    <table class="table table-hover ">
    <thead class="thead-inverse">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
           @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-center">Actions</th>
                        @endif

        </tr>
        </thead>
        <tbody>
           @foreach($users as $user)
 <tr>
                <td scope="row">{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>@foreach($user->roles as $role)
                    <li>{{ $role->title }}</li>
                    @endforeach
                </td>
                <td class="text-center">
                                                  @if ($user && $user->hasPermission('edit permission'))

                    <a wire:navigate href="{{ route('admin.users.edit',$user->id) }}" class="btn btn btn-secondary">
                   <i class="bi bi-pencil-square"></i>

                    </a>
                                                        @endif

                              @if ($user && $user->hasPermission('delete permission'))
                 <button
                                    onclick="confirm('Are you sure you wish to DELETE this User?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $role->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                   @endif

                    </a>
                </td>
             
            </tr>   
           @endforeach
           
        </tbody>
  </table>
  </div>
 </div>

</div>
