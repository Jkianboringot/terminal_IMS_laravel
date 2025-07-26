<div>
    <x-slot name="head">Users</x-slot>
    @php
        $currentuser = auth()->user();
        $isSuperAdmin = $currentuser->roles->contains('title', 'Super Administrator');
    @endphp

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Users List</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        @if ($isSuperAdmin)
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @php
                            $targetIsSuperAdmin = $user->roles->contains('title', 'Super Administrator');
                        @endphp
                        <tr>
                            <td scope="row">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <li>{{ $role->title }}</li>
                                @endforeach
                            </td>

                            @if ($isSuperAdmin )
                                <td class="text-center">
                                    @if (!$targetIsSuperAdmin && $currentuser->id !== $user->id)
                                        <div class="d-flex flex-wrap gap-1 justify-content-center">
                                            <a wire:navigate href="{{ route('admin.users.edit', $user->id) }}" class="btn btn btn-secondary">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <button
                                                onclick="confirm('Are you sure you wish to DELETE this User?') || event.stopImmediatePropagation()"
                                                class="btn btn-danger" wire:click='delete({{ $user->id }})'>
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
