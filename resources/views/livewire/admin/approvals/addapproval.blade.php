<div>
    <x-slot:header>Pending Approvals</x-slot:header>
   

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Product Approvals</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>Supplier</th>
                        <th>Date</th>
                        <th>Products</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pendingRequests as $request)
                        <tr>
                            <td>{{ $request->supplier->name }}</td>
                            <td>{{ $request->add_product_date }}</td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach($request->products as $p)
                                        <li>{{ $p->name }} (Qty: {{ $p->pivot->quantity }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-center">
                                    <button wire:click="approve({{ $request->id }})"
                                        class="btn btn-success btn-sm">
                                        <i class="bi bi-check-lg"></i> Approve
                                    </button>

                                    <button wire:click="reject({{ $request->id }})"
                                        class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-lg"></i> Reject
                                    </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No pending approvals.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
