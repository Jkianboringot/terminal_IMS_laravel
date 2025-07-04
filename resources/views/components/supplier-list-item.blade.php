@props(["supplier",'purchase'])

<li wire:click="selectSupplier({{ $supplier->id }})"
    class="list-group-item {{ $supplier->id == $purchase->supplier_id ? 'active' : '' }} d-flex justify-content-between">
    <div class="me-auto">
        <h5>{{ $supplier->name }}</h5>
        <p>{{ $supplier->email}}</p>
    </div>
</li>