<div>
    <x-slot:head>Banks</x-slot:head>

    @php
    $user = auth()->user();
    @endphp
    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Bank List</h5>
        </div>
        <div class="card-body table-responsive">
            
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Search by product name..."
                   class="form-control mb-3 @if($search) border border-primary @endif">

            <table class="table table-hover ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Short Name</th>
                        <th>Sort Code</th>
                        <th>Number of Clients</th>
                        <th>Number of Suppliers</th>

                        @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-center">Actions</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach($banks as $bank)
                    <tr>
                        <td scope="row">{{ $bank->id  }}</td>
                        <td>{{ $bank->name }}</td>
                        <td>{{ $bank->short_name }}</td>
                        <td>{{ $bank->sort_code }}</td>
                        <td>{{ count($bank->clients) }}</td>
                        <td>{{ count($bank->suppliers) }}</td>

                        </td>
                        <td class="text-center">
                            
                              @if ($user && $user->hasPermission('edit permission'))
                            <a wire:navigate href="{{ route('admin.banks.edit',$bank->id) }}" class="btn btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>

                            </a>
                                                                @endif

                              @if ($user && $user->hasPermission('delete permission'))
                            <button
                                onclick="confirm('Are you sure you wish to DELETE this Bank?')||event.stopImmediatePropagation()"
                                class="btn btn-danger" wire:click='delete({{ $bank->id }})'>
                                <i class="bi bi-trash-fill"></i>
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