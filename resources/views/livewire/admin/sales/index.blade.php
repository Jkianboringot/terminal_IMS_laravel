<div>
    <x-slot:header>Sales</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Sales' list</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Sale Date</th>
                        <th>Client</th>
                        <th>Total Amount</th>
                        <th>Status</th>

                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td scope="row">{{ $sale->id }}</td>
                            <td>
                                <h6>{{Carbon\Carbon::parse($sale->client_id)->format('jS F,Y') }}</h6>
                            </td>
                            <td>{{ $sale->client->name }}</td>
                            <td> <small>PISO {{ number_format($sale->total_amount, 2)}}</small></td>
                            <td>
                                <span class={{ $sale->is_paid ? 'text-success' : 'text-danger' }} style="font: bold">
                                {{ $sale->is_paid ? 'Paid' : 'Not Paid' }}</span>
                            </td>
                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.sales.edit', $sale->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to DELETE this Sale?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $sale->id }})'>
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