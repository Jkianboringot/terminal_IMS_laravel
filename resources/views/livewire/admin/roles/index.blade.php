<div>
    <x-slot name="header">Roles</x-slot>

    @php
        $user = auth()->user();
    @endphp

    <div class="card shadow-sm">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5 class="mb-0">Roles List</h5>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Users</th>
                        <th class="text-center">Permissions</th>
                        @if ($user && ($user->hasPermission('edit permission') || $user->hasPermission('delete permission')))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->title }}</td>
                            <td>{{ count($role->users) }}</td>

                            <td>
                                <ul class="row list-unstyled mb-0">
                                    @foreach (json_decode($role->permissions) as $permission)
                                        <li class="col-md-4 col-sm-6 col-12">{{ $permission }}</li>
                                    @endforeach
                                </ul>
                            </td>

                            @if ($user && ($user->hasPermission('edit permission') || $user->hasPermission('delete permission')))
                                <td class="text-center">
                                    <div class="d-flex flex-wrap gap-1 justify-content-center">
                                        @if ($user->hasPermission('edit permission'))
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-secondary">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endif

                                        @if ($user->hasPermission('delete permission'))
                                            <button class="btn btn-sm btn-danger"
                                                onclick="confirm('Are you sure you wish to DELETE this Role?') || event.stopImmediatePropagation()"
                                                wire:click='delete({{ $role->id }})'>
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        @endif

                                        @if ($role->id == 1 && json_decode($role->permissions) != config('permissions.permissions'))
                                            <button class="btn btn-sm btn-primary"
                                                onclick="confirm('Are you sure you wish to UPDATE this role\'s permissions?') || event.stopImmediatePropagation()"
                                                wire:click='updatePermissions({{ $role->id }})'>
                                                <i class="bi bi-arrow-repeat"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
