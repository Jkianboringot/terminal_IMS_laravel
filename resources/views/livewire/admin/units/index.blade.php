<div>
    <x-slot:header>Units</x-slot:header>

    @php
    $user = auth()->user();
@endphp
    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Units' List</h5>
        </div>
        <div class="card-body table-responsive">
               <div class="card-body table-responsive">
                <input type="text"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Search by product name..."
                   class="form-control mb-3 @if($search) border border-primary @endif">

            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Symbol</th>
                        <th>Number of Products</th>
                      @can('edit permission')
                        <th class="text-center">Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $unit)
                        <tr>
                            <td scope="row">{{ $unit->id }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->symbol }}</td>
                            <td>{{ $unit->products->count() }}</td>

                            <td class="text-center">
                      @can('edit permission')
                                
                                <a href="{{ route('admin.units.edit', $unit->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button onclick="confirm('Are you sure you wish to DELETE this Unit?')||event.stopImmediatePropagation()" class="btn btn-danger" wire:click='delete({{ $unit->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>