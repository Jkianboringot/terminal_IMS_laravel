
<div>
    <x-slot:header>Returns</x-slot:header>

    <div class="row justify-content-center">
        {{-- LEFT SIDE --}}
        <div class="col-md-4 col-6">
            <div class="card mt-2">
                <div class="card-header bg-inv-primary text-inv-secondary border-0">
                    <h6>Add a Product to Return</h6>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Product Search</label>
                        <input type="text" wire:model.live='returnSearch' class="form-control" />
                        <ul class="list-group mt-2 w-100">
                            @if ($returnSearch != '')
                                @foreach ($products as $product)
                                    <x-product-list-item :product="$product" :selectedProductId="$selectedProductId" />
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input wire:model='quantity' type="number" min='0' class="form-control" />
                                @error('quantity')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Return</label>
                                <input wire:model.live="return.return_date" type="date" class="form-control" />
                                @error('return.return_date')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Return Type</label>
                        <select wire:model="return.return_type" class="form-control">
                            <option value="">-- Select Type --</option>
                            <option value="customer">Customer Return</option>
                            <option value="supplier">Supplier Return</option>
                        </select>
                        @error('return.return_type')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reason</label>
                        <textarea wire:model="return.reason" class="form-control"></textarea>
                        @error('return.reason')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" wire:model="restock" class="form-check-input" id="restockCheck">
                        <label class="form-check-label" for="restockCheck">Restock this item</label>
                    </div>

                    <button onclick="confirm('Are you sure you want to add this item to return list?')||event.stopImmediatePropagation()"
                        wire:click='addToList' class="btn btn-dark text-inv-secondary">
                        Add To List
                    </button>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-md-8 col-6">
            <div class="card shadow" id="cart-section">
                <div class="card-header bg-inv-secondary text-inv-primary border-0">
                    <h5 class="text-center text-uppercase">Return Items</h5>
                </div>
                <div class="card-body">
                    @if ($productList && count($productList) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                    <th>Restock?</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($productList as $key => $listItem)
                                    <tr>
                                        <td>{{ App\Models\Product::find($listItem['product_id'])->name }}</td>
                                        <td>{{ $listItem['quantity'] }}</td>
                                        <td>PISO {{ number_format($listItem['price'], 2) }}</td>
                                        <td>PISO {{ number_format($listItem['quantity'] * $listItem['price'], 2) }}</td>
                                        <td>
                                            @if($listItem['restock'])
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="badge bg-danger">No</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button onclick="confirm('Are you sure?')||event.stopImmediatePropagation()"
                                                wire:click='deleteCartItem({{ $key }})'
                                                class="btn btn-danger">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @php $total += $listItem['quantity'] * $listItem['price']; @endphp
                                @endforeach
                                <tr>
                                    <td colspan="3"><strong>TOTAL</strong></td>
                                    <td><strong>PISO {{ number_format($total, 2) }}</strong></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex gap-2 mt-3">
                            <button onclick="confirm('Confirm return?')||event.stopImmediatePropagation()"
                                wire:click='save' class="btn btn-success flex-fill">
                                <i class="bi bi-check2-circle me-1"></i> Save Return
                            </button>

                            <button onclick="confirm('Cancel this return?')||event.stopImmediatePropagation()"
                                wire:click='cancel' class="btn btn-outline-secondary flex-fill">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </button>
                        </div>
                    @else
                        <p class="text-center text-muted">No items yet. Add products to return.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
