<div>
    <x-slot:header>Purchases</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Purchases' list</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Purchase Date</th>
                        <th>Supplier</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                       
                 <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td scope="row">{{ $purchase->id }}</td>
                            <td>
                                <h6>{{ $purchase->supplier_id }}</h6>
                                <small>{{ $purchase->supplier->name }}</small><br>
                                <small>KES{{ number_format($purchase-> total_amount,2)}}</small>
                            </td>
                            <td></td>

                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.purchases.edit', $purchase->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to DELETE this Purchase?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $purchase->id }})'>
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