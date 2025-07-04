@props(["client", 'sale'])

<li wire:click="selectClient({{ $client->id }})"
    class="list-group-item {{ $client->id == $sale->client_id ? 'active' : '' }} d-flex justify-content-between">
    <div class="me-auto ">
        <h7 class='text-inv-secondary'>{{ $client->name }}</h7><br>
        <small class='text-muted'>{{ $client->email}} <br>{{ $client->phone_number }}</small>
    </div>
    <div class="mx-auto my-auto  ">
        <h7>Account Details: </h7><br>
        <small class='text-muted'>{{ $client->bank->name }} <br> {{ $client->account_number}}</small>
    </div>
    <div class="ms-auto my-auto {{$client->total_balance > 0 ? 'text-cash-green' : 'text-cash-red' }} ">
        <h7>PISO {{ number_format($client->total_balance, 2) }}</h7>

    </div>
</li>