<!-- <div>
    <x-slot:header>Pending Approvals</x-slot:header>

    {{-- Add Products --}}
    <div class="card mb-4">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Add Product Approvals</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
            
                        <th>Products</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingAddProducts as $request)
                        <tr>
                            <td>{{ $request->add_product_date }}</td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach($request->products as $p)
                                        <li>{{ $p->name }} (Qty: {{ $p->pivot->quantity }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-center">
                                <button wire:click="approve({{ $request->id }}, 'AddProduct')" class="btn btn-success btn-sm">
                                    <i class="bi bi-check-lg"></i> Approve
                                </button>
                                <button wire:click="reject({{ $request->id }}, 'AddProduct')" class="btn btn-danger btn-sm">
                                    <i class="bi bi-x-lg"></i> Reject
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted">No pending Add Products.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Unsuccessful Transactions --}}
    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Unsuccessful Transaction Approvals</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Products</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingUnsuccessful as $request)
                        <tr>
                            <td>{{ $request->unsuccessful_transactions_date }}</td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach($request->products as $p)
                                        <li>{{ $p->name }} (Qty: {{ $p->pivot->quantity ?? 'N/A' }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-center">
                                <button wire:click="approve({{ $request->id }}, 'UnsuccessfulTransaction')" class="btn btn-success btn-sm">
                                    <i class="bi bi-check-lg"></i> Approve
                                </button>
                                <button wire:click="reject({{ $request->id }}, 'UnsuccessfulTransaction')" class="btn btn-danger btn-sm">
                                    <i class="bi bi-x-lg"></i> Reject
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted">No pending Unsuccessful Transactions.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div> -->
