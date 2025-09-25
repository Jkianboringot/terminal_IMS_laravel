<div>
    <x-slot:header>Pending Approvals</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Approval Center</h5>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs" id="approvalTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="add-products-tab" data-bs-toggle="tab"
                        data-bs-target="#add-products" type="button" role="tab">New Products</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="unsuccessful-tab" data-bs-toggle="tab"
                        data-bs-target="#unsuccessful" type="button" role="tab">Unsuccessful Transactions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="edits-tab" data-bs-toggle="tab"
                        data-bs-target="#edits" type="button" role="tab">Edit Requests</button>
                </li>
            </ul>

            <div class="tab-content mt-3">
                {{-- ✅ New Products --}}
                <div class="tab-pane fade show active" id="add-products" role="tabpanel">
                    @forelse($pendingAddProducts as $request)
                        <div class="card mb-2">
                            <div class="card-body">
                                <b>
                                    @foreach($request->products as $product)
                                        {{ $product->name }} (x{{ $product->pivot->quantity }})<br>
                                    @endforeach
                                </b>
                                <div class="mt-2">
                                    <button wire:click="approve({{ $request->id }}, 'AddProduct')" class="btn btn-success btn-sm">
                                        <i class="bi bi-check-lg"></i> Approve
                                    </button>
                                    <button wire:click="reject({{ $request->id }}, 'AddProduct')" class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-lg"></i> Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No pending product approvals.</p>
                    @endforelse
                </div>

                {{-- ✅ Unsuccessful Transactions --}}
                <div class="tab-pane fade" id="unsuccessful" role="tabpanel">
                    @forelse($pendingUnsuccessful as $request)
                        <div class="card mb-2">
                            <div class="card-body">
                                <b>
                                    @foreach($request->products as $product)
                                        {{ $product->name }} (x{{ $product->pivot->quantity }})<br>
                                    @endforeach
                                </b>
                                <div class="mt-2">
                                    <button wire:click="approve({{ $request->id }}, 'UnsuccessfulTransaction')" class="btn btn-success btn-sm">
                                        <i class="bi bi-check-lg"></i> Approve
                                    </button>
                                    <button wire:click="reject({{ $request->id }}, 'UnsuccessfulTransaction')" class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-lg"></i> Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No pending unsuccessful transactions.</p>
                    @endforelse
                </div>

                {{-- ✅ Edit Requests --}}
                <div class="tab-pane fade" id="edits" role="tabpanel">
                    @forelse($pendingEdits as $edit)
                        <div class="card mb-2">
                            <div class="card-body">
                                <p>Edit request for:</p>
                                @foreach($edit->addProduct->products as $product)
                                    <b>{{ $product->name }} (x{{ $product->pivot->quantity }})</b><br>
                                @endforeach

                                <pre class="bg-light p-2 rounded mt-2">{{ json_encode($edit->changes, JSON_PRETTY_PRINT) }}</pre>

                                <div class="mt-2">
                                    <button wire:click="approve({{ $edit->id }}, 'Edit')" class="btn btn-success btn-sm">
                                        <i class="bi bi-check-lg"></i> Approve
                                    </button>
                                    <button wire:click="reject({{ $edit->id }}, 'Edit')" class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-lg"></i> Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No pending edit requests.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
