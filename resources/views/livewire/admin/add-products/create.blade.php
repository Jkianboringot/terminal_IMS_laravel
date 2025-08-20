<div>
    <x-slot:header>Add Product</x-slot:header>
    <div class="row justify-content-center">
        <div class="col-md-4 col-6 @if (!$productList)
            w-50
        @endif">
            <div class="card">
                <div class="card-header  bg-inv-primary text-inv-secondary border-0">
                    <h5>Set Date & Supplier</h5>
                </div>
                <div class="card-body ">
                    <div class="mb-3">
                        <label for="" class="form-label">Date of Purchase</label>
                        <input wire:model.live="addProduct.purchase_date" type="date" class="form-control" />
                        @error('addProduct.purchase_date')
                            <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                        @enderror
                    </div>

                 
                    <div class="mb-3">
                        <label for="" class="form-label">Supplier Search</label>
                        <input type="text" wire:model.live='supplierSearch' class="form-control" />
                        @error('addProduct.supplier_id')
                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <ul class="list-group mt-2 w-100">
                            @if ($supplierSearch != '')
                                @foreach ($suppliers as $supplier)
                                    <x-add-product-supplier-list-item :supplier="$supplier" :addProduct="$addProduct"/>
                                    <!-- this is just like in php bindPram -->
                                @endforeach
                            @endif
                        </ul>
                    </div>

                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header  bg-inv-primary text-inv-secondary border-0">

                    <h6> Add Product to List</h6>
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
                        <div class="col-md-12">

                            <div class="mb-3">
                                <label for="" class="form-label">Quantity</label>
                                <input wire:model='quantity' type="number" min='0' class="form-control" />
                                @error('quantity')
                                    <small id="helpId" class="form-text text-danger">{{ $message }} </small>
                                @enderror
                            </div>
                        </div>
                        
                    </div>

                    <button
                        onclick="confirm('Are you sure you wish to Add this Purchas')||event.stopImmediatePropagation()"
                        wire:click='addToList' class="btn btn-dark text-inv-secondary">Add To List</button>
                </div>

            </div>




            
        </div>
        @if ($productList)
            <div class="col-md-8 col-6">
                <div class="card shadow">
                    <div class="card-header  bg-inv-secondary text-inv-primary border-0">

                        <h5 class="text-center text-uppercase">To be Added to Product List</h5>
                    </div>
                    <div class="card-body">
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
                                            <td class="text-center"><strong >{{ $listItem['quantity'] }}</strong></td>
                                          
                                          
                                            <td class="text-center">

                                                @if ($listItem['quantity']>1)
                                                <button wire:click='subtractQuantity({{ $key }})' class="btn btn-danger">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                @endif
                                              
                                               
                                                
                                                 <button wire:click='addQuantity({{ $key }})' class="btn btn-success">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                                
                                                  <button   onclick="confirm('Are you sure you want to delete this Purchase')||event.stopImmediatePropagation()"  wire:click='deleteCartItem({{ $key }})' 
                                                  class="btn btn-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>

                                            </td>

                                        </tr>

                                     

                                    @endforeach
                                  
                                @endif


                            </tbody>
                        </table>
                 
                            <button
                        onclick="confirm('Are you sure you wish to make the Purchase')||event.stopImmediatePropagation()"
                        wire:click='addProductToList' class="btn btn-dark text-inv-secondary w-100">Add to Product list</button>
                      
                    </div>
                </div>
            </div>

        @endif
    </div>
</div>

</div>


<!-- after this make the supplier id and product a drop down and search because its annoying just being able to searcjh -->




<!-- 
what and what not to keep
i want to keep the first ui when you click addProducts create but only git rid of unit price since i 
wnat that to be already in product but i also want the addlist ui after the first one so that they can check
if what they inputed is correct and if the supplier has one or mroe item to be added they can just edit it to add more
so i will not get rid of it prior to my prev jugdement of getting rid of it but if i do git rid of it
then the user will have to add product one by on intead of adding it all at once -->
