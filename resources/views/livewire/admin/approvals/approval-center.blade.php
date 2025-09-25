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
                    <button class="nav-link" id="returns-tab" data-bs-toggle="tab"
                        data-bs-target="#returns" type="button" role="tab">Return Requests</button>
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
                <div class="tab-pane fade show active" id="add-products" role="tabpanel">
                    @if($pendingAddProducts->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Date</th>
                                    <th>No. of Units</th>
                                    <th>Bar Code</th>
                                    <th>Products</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingAddProducts as $request)
                                <tr>
                                    <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $request->products->sum('pivot.quantity') }}</td>
                                    <td>{{ $request->barcode ?? '—' }}</td>
                                    <td>
                                        @foreach($request->products as $product)
                                        {{ $product->name }} (x{{ $product->pivot->quantity }})<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <button wire:click="approve({{ $request->id }}, 'AddProduct')" class="btn btn-success btn-sm">
                                            <i class="bi bi-check-lg"></i> Approve
                                        </button>
                                        <button wire:click="reject({{ $request->id }}, 'AddProduct')" class="btn btn-danger btn-sm">
                                            <i class="bi bi-x-lg"></i> Reject
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-muted">No pending product approvals.</p>
                    @endif
                </div>

                <div class="tab-pane fade" id="returns" role="tabpanel">
                    @if($pendingReturnItem->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Date</th>
                                    <th>No. of Units</th>
                                    <th>Products</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingReturnItem as $request)
                                <tr>
                                    <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $request->products->sum('pivot.quantity') }}</td>
                                    <td>
                                        @foreach($request->products as $product)
                                        {{ $product->name }} (x{{ $product->pivot->quantity }})<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <button wire:click="approve({{ $request->id }}, 'ReturnItem')" class="btn btn-success btn-sm">
                                            <i class="bi bi-check-lg"></i> Approve
                                        </button>
                                        <button wire:click="reject({{ $request->id }}, 'ReturnItem')" class="btn btn-danger btn-sm">
                                            <i class="bi bi-x-lg"></i> Reject
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-muted">No pending Returns.</p>
                    @endif
                </div>


                <div class="tab-pane fade" id="unsuccessful" role="tabpanel">
                    @if($pendingUnsuccessful->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Date</th>
                                    <th>No. of Units</th>
                                    <th>Products</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingUnsuccessful as $request)
                                <tr>
                                    <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $request->products->sum('pivot.quantity') }}</td>
                                    <td>
                                        @foreach($request->products as $product)
                                        {{ $product->name }} (x{{ $product->pivot->quantity }})<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <button wire:click="approve({{ $request->id }}, 'Unsuccessful')" class="btn btn-success btn-sm">
                                            <i class="bi bi-check-lg"></i> Approve
                                        </button>
                                        <button wire:click="reject({{ $request->id }}, 'Unsuccessful')" class="btn btn-danger btn-sm">
                                            <i class="bi bi-x-lg"></i> Reject
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-muted">No pending unsuccessful transactions.</p>
                    @endif
                </div>



                <div class="tab-pane fade" id="edits" role="tabpanel">
                    @if($pendingEdits->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Date</th>
                                    <th>Products</th>
                                    <th>Requested Changes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingEdits as $edit)
                                <tr>
                                    <td>{{ $edit->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @foreach($edit->addProduct->products as $product)
                                        {{ $product->name }} (x{{ $product->pivot->quantity }})<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <pre class="bg-light p-2 rounded small mb-0">{{ json_encode($edit->changes, JSON_PRETTY_PRINT) }}</pre>
                                    </td>
                                    <td>
                                        <button wire:click="approve({{ $edit->id }}, 'Edit')" class="btn btn-success btn-sm">
                                            <i class="bi bi-check-lg"></i> Approve
                                        </button>
                                        <button wire:click="reject({{ $edit->id }}, 'Edit')" class="btn btn-danger btn-sm">
                                            <i class="bi bi-x-lg"></i> Reject
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-muted">No pending edit requests.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



<!-- i need to make this a component becuase i sitll have to do this with return -->