<div>
    <x-slot:header>Roles</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Roles' List</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Users</th>
                        <th class="text-center w-50">Roles</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td scope="row">{{ $role->id }}</td>
                            <td>{{ $role->title }}</td>
                            <td>{{ count($role->users) }}</td>

                            <td>
                                <ol class="row">
                                    @foreach (json_decode($role->permissions) as $permission)
                                        <li class="col-3">{{ $permission }}</li>
                                    @endforeach
                                </ol>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to DELETE this Role?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $role->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                                @if ($role->id == 1 && json_decode($role->permissions) != config('permissions.permissions'))
                                    <button
                                        onclick="confirm('Are you sure you wish to UPDATE this roles permissions?')||event.stopImmediatePropagation()"
                                        class="btn btn-primary" wire:click='updatePermissions({{ $role->id }})'>
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>