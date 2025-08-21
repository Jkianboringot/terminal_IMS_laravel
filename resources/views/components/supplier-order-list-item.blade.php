@props(["supplier", 'order'])

<li wire:click="selectSupplier({{ $supplier->id }})"
    class="list-group-item {{ $supplier->id == $order->supplier_id ? 'active' : '' }} d-flex justify-content-between">
    <div class="me-auto ">
        <h7 class='text-inv-secondary'>{{ $supplier->name }}</h7><br>
        <small class='text-muted'>{{ $supplier->email}} <br>{{ $supplier->phone_number }}</small>
    </div>
   
    <div class="ms-auto my-auto {{$supplier->total_balance > 0 ? 'text-cash-red' : 'text-cash-green' }} ">
        <h7>PISO {{ number_format($supplier->total_balance, 2) }}</h7>

    </div>
</li>   