<div>
    <x-slot:head>Customers</x-slot:head>
 @php
    $user = auth()->user();
    @endphp

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Customers List</h5>
        </div>
        <div class="card-body table-responsive">
                <input type="text"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Search by product name..."
                   class="form-control mb-3 @if($search) border border-primary @endif">

            <table class="table table-hover ">
                <thead class="thead-inverse">
                    <tr>
                        <th>Basic Details</th>
                        <th>Address</th>
                        <th>Business Registration</th>
                        <th>Organization Type</th>

                        <th>Purchases Made</th>
                           <th>Total Purchases Value</th>
                      @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-center">Actions</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>
                                <h6> {{ $customer->name }}</p>
                                    <small> {{ $customer->email }}</small><br>
                                    <small> {{ $customer->phone_number??'N/A' }}</small>

                            </td>
                            <td>{{ $customer->address??'N/A' }}</td>
                            <td>
                                <small><strong>TIN ID:</strong>{{ $customer->tax_id }}</small><br>
                            </td>
                           <td>{{ $customer->organization_type??'N/A' }}</td>
                            <td>
                                {{ $customer->sales->count() }}
                            </td>
                              <td>
                               <small>PISO </small>{{ number_format($customer->sales->sum(function($sale){return $sale->total_amount;})) }}
                            </td>
                            <td class="text-center">
                                                              @if ($user && $user->hasPermission('edit permission'))

                                <a wire:navigate href="{{ route('admin.customers.edit', $customer->id) }}"
                                    class="btn btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>

                                </a>
                                                                   @endif
                              @if ($user && $user->hasPermission('delete permission'))

                               <button
                                    onclick="confirm('Are you sure you wish to DELETE this Customer?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $customer->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                                                    @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
             

            </table>
     {{ $customers->links('pagination::bootstrap-5') }}

        </div>
    </div>
</div>

</div>