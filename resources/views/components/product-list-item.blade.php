@props(['product', 'selectedProductId'])
<li wire:click='selectProduct({{ $product->id }})'
    class="list-group-item {{ $product->id == $selectedProductId ? 'active' : '' }} d-flex ">
    <div class="me-auto">
        <img src="https://via.placeholder.com/150" class="img-fluid rounded-top" alt="" height="100%" />

    </div>
    <div class="m-3" style="max-width: 30%">
        <h7 class="text-capitalize text-inv-secondary">{{ $product->brand->name }}</h7>
        <h6>{{ $product->name }}</h6>
        <small class="text-muted">{{ $product->description }}</small>
    </div>

    <div class="my-auto m-3 {{ $product->inventory_balance > 0 ? 'text-cash-green' : 'text-cash-red' }}">
        <h6 class="text-secondary">Balance:</h6>
        <h6>
            {{ $product->inventory_balance }} <br>Units
        </h6>
    </div>
    <div class="ms-auto my-auto m-3">
        <h6 class="text-capitalize text-inv-primary">Price</h6>
        <small>Purchase: </small>
        <h6>{{ number_format($product->purchase_price, 2) }}</h6>
        <small>Selling: </small>
        <h6>{{ number_format($product->sale_price, 2) }}</h6>
    </div>
</li>