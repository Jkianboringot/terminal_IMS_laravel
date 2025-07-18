<div>
    <x-slot:head>Suppliers</x-slot:head>
    @php
    $user = auth()->user();
    @endphp

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Suppliers List</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Basic Details</th>
                        <th>Address</th>
                        <th>Business Details</th>
                        <th>Accounts Details</th>
                        <th>Purchases Made</th>
                        <th>Total Purchases Value</th>
                        @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-center">Actions</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <td scope="row">{{ $supplier->id }}</td>
                        <td>
                            <h6> {{ $supplier->name }}</p>
                                <small> {{ $supplier->email }}</small> <br>
                                <small> {{ $supplier->number??'N/A' }}</small>

                        </td>
                        <td>{{ $supplier->address??'N/A' }}</td>
                        <td>
                            <small><strong>TAX ID:</strong>{{ $supplier->tax_id }}</small><br>
                            <small><strong>Reg NO :</strong>{{ $supplier->registration_number??'N/A' }}</small>
                        </td>
                        <td>
                            <small><strong>Bank:</strong>{{ $supplier->bank->name }}</small><br>
                            <small><strong>A/c NO:</strong>{{ $supplier->account_number }}</small>
                        </td>
                        <td>
                            {{ $supplier->purchases->count() }}
                        </td>
                        <td>
                            <small>PISO </small>{{ number_format($supplier->purchases->sum(function($purchase){return $purchase->total_amount;})) }}
                        </td>
                        <td class="text-center">
                            @if ($user && $user->hasPermission('edit permission'))

                            <a wire:navigate href="{{ route('admin.suppliers.edit', $supplier->id) }}"
                                class="btn btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>

                            </a>
                            @endif
                            @if ($user && $user->hasPermission('delete permission'))

                            <button
                                onclick="confirm('Are you sure you wish to DELETE this Supplier?')||event.stopImmediatePropagation()"
                                class="btn btn-danger" wire:click='delete({{ $supplier->id }})'>
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            @endif

                        </td>

                    </tr>
                    @endforeach
                </tbody>


            </table>
            {{ $suppliers->links('pagination::bootstrap-5') }}

        </div>
    </div>

</div>