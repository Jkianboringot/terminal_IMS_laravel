<div>
    <x-slot:header>Add Product</x-slot:header>
    <div class="row justify-content-center">
        {{-- LEFT SIDE --}}
        <div class="col-md-4 col-6">
            
            {{-- Card: Set Date & Supplier --}}
            <div class="card">
                <div class="card-header bg-inv-primary text-inv-secondary border-0">
                    <h5>Set Date & Supplier</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Date of Purchase</label>
                        <input wire:model.live="addProduct.add_product_date" type="date" class="form-control" />
                        @error('addProduct.add_product_date')
                            <small class="form-text text-danger">{{ $message }} </small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Supplier Search</label>
                        <input type="text" wire:model.live="supplierSearch" class="form-control" />
                        @error('addProduct.supplier_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <ul class="list-group mt-2 w-100">
                            @if ($supplierSearch != '')
                            @forelse ($suppliers as $supplier)
                            <x-add-product-supplier-list-item
                                :supplier="$supplier"
                                :addProduct="$addProduct" />
                            @empty
                            <p>No Supplier yet.</p>
                            @endforelse
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Card: Add Product to List --}}
            <div class="card mt-2">
                <div class="card-header bg-inv-primary text-inv-secondary border-0">
                    <h6>Add Product to List</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Search</label>
                        <input type="text" wire:model.live="productSearch" class="form-control" />
                        <ul class="list-group mt-2 w-100">
                            @if ($productSearch != '')
                                @forelse ($products as $product)
                                    <x-product-list-item 
                                        :product="$product" 
                                        :selectedProductId="$selectedProductId"/>
                                        @empty
                                        <p>No Products yet.</p>
                                @endforelse
                            @endif
                        </ul>
                    </div>
                    
                    <div class="mb-3">
                        <label for="" class="form-label">Quantity</label>
                        <input wire:model="quantity" type="number" min="0" class="form-control" />
                        @error('quantity')
                            <small class="form-text text-danger">{{ $message }} </small>
                        @enderror
                    </div>

                    <button
                        onclick="confirm('Are you sure you wish to add this product?')||event.stopImmediatePropagation()"
                        wire:click="addToList"
                        class="btn btn-dark text-inv-secondary w-100">
                        Add To List
                    </button>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE (Cart) --}}
        <div class="col-md-8 col-6">
            <div class="card shadow">
                <div class="card-header bg-inv-secondary text-inv-primary border-0">
                    <h5 class="text-center text-uppercase">To be Added to Product List</h5>
                </div>
                <div class="card-body">
                    @if ($productList && count($productList) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th class="text-center">Product Quantity</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productList as $key => $listItem)
                                    <tr>
                                        <td scope="row">{{ App\Models\Product::find($listItem['product_id'])->id }}</td>
                                        <td>
                                            {{ App\Models\Product::find($listItem['product_id'])->name }} <br>
                                            <small class="text-muted">
                                                {{ App\Models\Product::find($listItem['product_id'])->quantity }}
                                                {{ App\Models\Product::find($listItem['product_id'])->unit->name }}
                                            </small>
                                        </td>
                                        <td class="text-center"><strong>{{ $listItem['quantity'] }}</strong></td>
                                        <td class="text-center">
                                            @if ($listItem['quantity'] > 1)
                                                <button wire:click="subtractQuantity({{ $key }})" class="btn btn-danger">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                            @endif
                                            <button wire:click="addQuantity({{ $key }})" class="btn btn-success">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                            <button 
                                                onclick="confirm('Are you sure you want to delete this item?')||event.stopImmediatePropagation()"
                                                wire:click="deleteCartItem({{ $key }})"
                                                class="btn btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex gap-2 mt-3">
                        <button
                            onclick="confirm('Are you sure you wish to make the Sale?')||event.stopImmediatePropagation()"
                            wire:click='save'
                            class="btn btn-success flex-fill">
                            <i class="bi bi-cart-check me-1"></i> Make Sale
                        </button>

                        <button
                            onclick="confirm('Are you sure you wish to cancel?')||event.stopImmediatePropagation()"
                            wire:click='cancel'
                            class="btn btn-outline-secondary flex-fill">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </button>
                    </div>
                    @else
                        <p class="text-center text-muted">Your cart is empty. Add a product to get started.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
