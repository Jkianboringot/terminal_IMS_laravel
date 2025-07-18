<div>
    <x-slot:head>Clients</x-slot:head>
 @php
    $user = auth()->user();
    @endphp

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Clients List</h5>
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
                    @foreach($clients as $client)
                        <tr>
                            <td scope="row">{{ $client->id }}</td>
                            <td>
                                <h6> {{ $client->name }}</p>
                                    <small> {{ $client->email }}</small><br>
                                    <small> {{ $client->number??'N/A' }}</small>

                            </td>
                            <td>{{ $client->address??'N/A' }}</td>
                            <td>
                                <small><strong>TAX ID:</strong>{{ $client->tax_id }}</small><br>
                                <small><strong>Reg NO :</strong>{{ $client->registration_number??'N/A' }}</small>
                            </td>
                             <td>
                                <small><strong>Bank:</strong>{{ $client->bank->name }}</small><br>
                                <small><strong>A/c NO:</strong>{{ $client->account_number }}</small>
                            </td>
                            <td>
                                {{ $client->sales->count() }}
                            </td>
                              <td>
                               <small>PISO </small>{{ number_format($client->sales->sum(function($sale){return $sale->total_amount;})) }}
                            </td>
                            <td class="text-center">
                                                              @if ($user && $user->hasPermission('edit permission'))

                                <a wire:navigate href="{{ route('admin.clients.edit', $client->id) }}"
                                    class="btn btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>

                                </a>
                                                                   @endif
                              @if ($user && $user->hasPermission('delete permission'))

                               <button
                                    onclick="confirm('Are you sure you wish to DELETE this Client?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $client->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                                                    @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
             

            </table>
     {{ $clients->links('pagination::bootstrap-5') }}

        </div>
    </div>

</div>