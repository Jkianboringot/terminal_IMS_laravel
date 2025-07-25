<div >

    <x-slot:header>Sales</x-slot:header>
    <div class="row justify-content-center">
        <div class="col-md-4 col-6 @if (!$productList)
            w-50
        @endif">
            <div class="card">
                <div class="card-header  bg-inv-primary text-inv-secondary border-0">
                    <h5>Set Date & Client</h5>
                </div>
                <div class="card-body ">
                    <div class="mb-3">
                        <label for="" class="form-label">Date of Sale</label>
                        <input wire:model.live="sale.sale_date" type="date" class="form-control" />
                        @error('sale.sale_date')
                            <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Client Search</label>
                        <input type="text" wire:model.live="clientSearch" class="form-control" />
                          @error('sale.client_id')
                            <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                        @enderror
                          <ul class="list-group mt-2 w-100">
                        @if ($clientSearch != '')
                            @foreach ($clients as $client)
                                     <x-client-list-item :client="$client" :sale="$sale"/>
                            @endforeach
                        @endif
</ul>
                    </div>

                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header  bg-inv-primary text-inv-secondary border-0">

                    <h6> Add a Product to List</h6>
                </div>

                <div class="card-body ">
                  <div class="mb-3">
                        <label for="" class="form-label">Product Search</label>
                        <input type="text" wire:model.live='productSearch' class="form-control" />
                        <ul class="list-group mt-2 w-100">
                            @if ($productSearch != '')
                                @foreach ($products as $product)
                                    <x-product-list-item :product="$product" :selectedProductId="$selectedProductId"/>
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
        @if ($productList)
            <div class="col-md-8 col-6" wire:keydown.enter="makeSale" wire:keydown.escape="cancelEdit" tabindex="0">
                <div class="card shadow">
                    <div class="card-header  bg-inv-secondary text-inv-primary border-0">

                        <h5 class="text-center text-uppercase">Cart</h5>
                    </div>
                    <div class="card-body" >
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($productList)
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($productList as $key => $listItem)
                                        <tr>
                                            <td scope="row">{{ App\Models\Product::find($listItem['product_id'])->id }}</td>
                                            <td>
                                                {{ App\Models\Product::find($listItem['product_id'])->name }} <br>
                                                <small
                                                    class="text-muted">{{ App\Models\Product::find($listItem['product_id'])->quantity . App\Models\Product::find($listItem['product_id'])->unit->name }}</small>
                                            </td>
                                            <td>{{ $listItem['quantity'] }}</td>
                                            <td>PISO {{ number_format($listItem['price'], 2) }}</td>
                                            <td>PISO {{ number_format($listItem['quantity'] * $listItem['price'], 2) }}</td>
                                            <td class="text-center">

                                                @if ($listItem['quantity']>1)
                                                <button wire:click='subtractQuantity({{ $key }})' class="btn btn-danger">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                @endif
                                              
                                               
                                                
                                                 <button wire:click='addQuantity({{ $key }})' class="btn btn-success">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                                
                                                  <button   onclick="confirm('Are you sure you want to delete this Sale')||event.stopImmediatePropagation()"  wire:click='deleteCartItem({{ $key }})' 
                                                  class="btn btn-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>

                                            </td>

                                        </tr>

                                        @php
                                            $total += $listItem['quantity'] * $listItem['price'];
                                        @endphp

                                    @endforeach
                                    <tr>
                                        <td colspan="2" style='font-size:18px'>
                                            <strong>TOTAL</strong>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td style='font-size:18px'>
                                            <strong>PISO {{ number_format($total, 2) }}</strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endif


                            </tbody>
                        </table>
                 
                            <button
                        onclick="confirm('Are you sure you wish to make the Sale')||event.stopImmediatePropagation()"
                        wire:click='makeSale' class="btn btn-dark text-inv-secondary w-100">Sale</button>
                      
                    </div>
                </div>
            </div>

        @endif
    </div>
</div>

</div>


<!-- after this make the client id and product a drop down and search because its annoying just being able to searcjh -->