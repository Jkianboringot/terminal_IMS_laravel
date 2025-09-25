<div>
    <x-slot:header>Pending Edit Requests</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Edit Requests</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Requested By</th>
                        <th>Proposed Changes</th>   
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingEdits as $edit)
                        <tr>
                            <td>{{ $edit->user->name }}</td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    
                                    <li>
                                        <strong>Date:</strong>
                                        {{ $edit->addProduct->add_product_date }} →
                                        {{ $edit->changes['add_product_date'] }}
                                    </li>

                                    {{-- Products change --}}
                                    <li><strong>Products:</strong>
                                        <ul>
                                            @foreach($edit->changes['products'] as $p)
                                                @php
                                                    $product = $edit->addProduct->products->firstWhere('id', $p['product_id']);
                                                    $oldQty = $product ? $product->pivot->quantity : 0;
                                                @endphp
                                                <li>
                                                    {{ $product ? $product->name : 'Unknown Product' }}
                                                    (Old: {{ $oldQty }} → New: {{ $p['quantity'] }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </td>
                            <td class="text-center">
                                <button wire:click="approve({{ $edit->id }})" class="btn btn-success btn-sm">
                                    <i class="bi bi-check-lg"></i> Approve
                                </button>

                                <button wire:click="reject({{ $edit->id }})" class="btn btn-danger btn-sm">
                                    <i class="bi bi-x-lg"></i> Reject
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No pending edit requests.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
