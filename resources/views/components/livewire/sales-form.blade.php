@props(['customerSearch',
'productSearch',
'customers',
'products',
'productList',
'sale','selectedProductId'

])





<div>
    <x-slot:header>Sales</x-slot:header>
    @if (session()->has('warning'))
    <div class="alert alert-warning d-flex justify-content-between align-items-center">
        <span>{{ session('warning') }}</span>
        <button wire:click="continueAnyway" class="btn btn-sm btn-outline-danger ms-2">
            Continue Anyway
        </button>
    </div>
    @endif
    <div class="row justify-content-center">
        {{-- LEFT SIDE --}}
        <div class="col-md-4 col-6">


            <div class="card mt-2">
                <div class="card-header bg-inv-primary text-inv-secondary border-0">
                    <h6>Add a Product to List</h6>
                </div>
                <div class="card-body">
<div class="mb-3">
                        <label for="" class="form-label">Customer Search</label>
                        <input type="text" wire:model.live="customerSearch" class="form-control" />
                          @error('sale.customer_id')
                            <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                        @enderror
                          <ul class="list-group mt-2 w-100">
                        @if ($customerSearch != '')
                            @foreach ($customers as $customer)
                                     <x-customer-list-item :customer="$customer" :sale="$sale"/>
                            @endforeach
                        @endif
                        
</ul>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Search</label>
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
                                <label class="form-label">Quantity</label>
                                <input wire:model='quantity' type="number" min='0' class="form-control" />
                                @error('quantity')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Sale</label>
                                <input wire:model.live="sale.sale_date" type="date" class="form-control" />
                                @error('sale.sale_date')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>

<x-livewire.partials.add-to-list-buttons/>

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
                                <th>Product Name</th>
                                <th>Product Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach ($productList as $key => $listItem)
                            <tr>
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
                                <td class="text-center">

                                    @php
                                    $product = App\Models\Product::find($listItem['product_id']);
                                    @endphp

                                    @if ($listItem['quantity'] > 1)
                                    <button wire:click='subtractQuantity({{ $key }})' class="btn btn-danger">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    @endif

                                    @if ($product && $product->inventory_balance > $listItem['quantity'])
                                    @php
                                    $remainingStock = $product->inventory_balance - $listItem['quantity'];
                                    $btnClass = $remainingStock <= 10 ? 'btn btn-danger' : 'btn btn-success' ;
                                        @endphp
                                        <button wire:click='addQuantity({{ $key }})' class="{{ $btnClass }}">
                                        <i class="bi bi-plus"></i>
                                        </button>
                                        @endif
                                        
                                        <button onclick="confirm('Are you sure you want to delete this Sale?')||event.stopImmediatePropagation()"
                                            wire:click='deleteCartItem({{ $key }})'
                                            class="btn btn-danger">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                </td>
                            </tr>
                            @php $total += $listItem['quantity'] * $listItem['price']; @endphp
                            @endforeach
                            <tr>
                                <td colspan="2" style='font-size:18px'><strong>TOTAL</strong></td>
                                <td></td>
                                <td style='font-size:18px'><strong>PISO {{ number_format($total, 2) }}</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex gap-2 mt-3">
                             <x-livewire.partials.save-buttons/>
                     

                       <x-livewire.partials.cancel-buttons/>
                    </div>

                    @else
                    <p class="text-center text-muted">Your cart is empty. Add a product to get started.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
