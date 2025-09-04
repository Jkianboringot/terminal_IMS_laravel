<div>
    <x-slot:header>Purchases</x-slot:header>
    <div class="row justify-content-center">
        {{-- LEFT SIDE --}}
        <div class="col-md-4 col-6">
            <div class="card">
                <div class="card-header bg-inv-primary text-inv-secondary border-0">
                    <h5>Set Date & Supplier</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Date of Purchase</label>
                        <input wire:model.live="purchase.purchase_date" type="date" class="form-control" />
                        @error('purchase.purchase_date')
                        <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                        @enderror
                    </div>
<div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="" class="form-label">Paid Status</label>
                               <select class="form-select " name="" id="">
                            <option value="null" selected>Select the Paid Status</option>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid / Pending</option>
                                    <option value="unpaid">Partially Paid</option>
                                    <option value="unpaid">Overdue</option>
                                    <option value="unpaid">Failed</option>
                                    <option value="unpaid">Refunded</option>
                                    <option value="unpaid">Canceled / Voided</option>
                                    <option value="unpaid">Processing</option>
                                    <!-- just create an array fro this -->
                        </select>
                                @error('')
                                <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Date Settled</label>
                               <input wire:model.live="purchase.purchase_date" type="date" class="form-control" />
                        @error('purchase.purchase_date')
                        <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                        @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Supplier Search</label>
                        <input type="text" wire:model.live='supplierSearch' class="form-control" />
                        @error('purchase.supplier_id')
                        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <ul class="list-group mt-2 w-100">
                            @if ($supplierSearch != '')
                            @foreach ($suppliers as $supplier)
                            <x-supplier-list-item :supplier="$supplier" :purchase="$purchase" />
                            @endforeach
                            @endif
                        </ul>
                    </div>
                  
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header bg-inv-primary text-inv-secondary border-0">
                    <h6>Add a Product to List</h6>
                </div>
               <div class="card-body ">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Search</label>
                        <input type="text" wire:model.live='productSearch' class="form-control" />
                        <ul class="list-group mt-2 w-100">
                            @if ($productSearch != '')
                            @foreach ($products as $product)
                            <x-product-list-item :product="$product" :selectedProductId="$selectedProductId" />
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="" class="form-label">Quantity</label>
                                <input wire:model='quantity' type="number" min='0' class="form-control" />
                                @error('quantity')
                                <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Unit Price</label>
                                <input wire:model='price' type="number" min='0' class="form-control" />
                                @error('price')
                                <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button
                        onclick="confirm('Are you sure you wish to Add this Purchas')||event.stopImmediatePropagation()"
                        wire:click='addToList' class="btn btn-dark text-inv-secondary">AddToList</button>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE (CART) --}}
        <div class="col-md-8 col-6">
            <div class="card shadow" id="cart-section">
                <div class="card-header bg-inv-secondary text-inv-primary border-0">
                    <h5 class="text-center text-uppercase">Cart</h5>
                </div>
                <div class="card-body">
                    @if ($productList && count($productList) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Data Settled</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Status</th>
                                    <th>Total Price</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($productList as $key => $listItem)
                                    <tr>
                                        <td><p class="form-control-plaintext">{{ date('Y-m-d') }}</p>
</td>
                                        <td>
                                            {{ App\Models\Product::find($listItem['product_id'])->name }} <br>
                                            <small class="text-muted">
                                                {{ App\Models\Product::find($listItem['product_id'])->quantity }}
                                                {{ App\Models\Product::find($listItem['product_id'])->unit->name }}
                                            </small>
                                        </td>
                                        <td>{{ $listItem['quantity'] }}</td>
                                        <td>PISO {{ number_format($listItem['price'], 2) }}</td>
                                        <td>PISO {{ number_format($listItem['quantity'] * $listItem['price'], 2) }}</td>
                                        <td>paid</td>
                                        <td class="text-center">
                                            @if ($listItem['quantity'] > 1)
                                                <button wire:click='subtractQuantity({{ $key }})' class="btn btn-danger">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                            @endif
                                            <button wire:click='addQuantity({{ $key }})' class="btn btn-success">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                            <button onclick="confirm('Are you sure you want to delete this Purchase')||event.stopImmediatePropagation()" 
                                                    wire:click='deleteCartItem({{ $key }})' 
                                                    class="btn btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @php $total += $listItem['quantity'] * $listItem['price']; @endphp
                                @endforeach
                                <tr>
                                    <td colspan="2" style='font-size:18px'><strong>TOTAL</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td style='font-size:18px'>
                                        <strong>PISO {{ number_format($total, 2) }}</strong>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                        <button onclick="confirm('Are you sure you wish to make the Purchase')||event.stopImmediatePropagation()" 
                                wire:click='makePurchase' 
                                class="btn btn-dark text-inv-secondary w-100">
                            Purchase
                        </button>
                    @else
                        <p class="text-center text-muted">Your cart is empty. Add a product to get started.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
