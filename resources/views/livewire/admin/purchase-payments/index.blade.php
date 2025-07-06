<div>
    <x-slot:header>Purchase_payment Payments</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Purchase_payment Payments list</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Date & Time</th>

                        <th>Supplier</th>
                        <th>Transaction reference</th>
                        <th>Attach Sales</th>
                        <th>Amount Paid</th>

                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchase_payments as $payment)
                        <tr>
                            <td scope="row">{{ $payment->id }}</td>
                            <td>
                                <h6>{{Carbon\Carbon::parse($payment->payment_time)->format('jS F,Y h:i:sA') }}</h6>
                            </td>
                            <td>
                                <h5>{{ $purchase_payment->supplier->name }}</h5>
                                <h6>Balance: <strong>PISO {{ $purchase_payment->supplier->balance }} </strong></h6>
                            </td>

                            <td> <small>{{ number_format($purchase_payment->trnasaction_reference, 2)}}</small></td>
                            <td>
                                @foreach ($payment->purchases as $purchase)
                                    <li>
                                        Purchase No: #{{ $purchase->id }} <br>
                                        {{ number_format($purchase->pivot->amount, 2)}}
                                    </li>
                                @endforeach
                            </td>

                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.purchase_payments.edit', $purchase_payment->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to DELETE this Purchase_payment?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $purchase_payment->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><strong>TOTALS</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> 
                            <strong> PISO {{ number_format($purchase_payments->sum(function ($payment) {
                            return $payment->pivot->amount; }),2) }}
                            </strong>
                        </td>
                        <td>
                            <strong>PISO {{ number_format($purchase_payments->sum(function ($payment) {
                            return $payment->amount; }),2) }}</strong>
                            </td>

                       
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>