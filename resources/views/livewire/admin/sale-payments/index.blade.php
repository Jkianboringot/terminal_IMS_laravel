<div>
    <x-slot:header>Sale Payments</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Sale Payments' list</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Date & Time</th>
                        <th>Client</th>
                        <th>Transaction Reference</th>
                        <th>Attached Sales</th>
                        <th>Amount paid</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales_payments as $payment)
                        <tr>
                            <td scope="row">{{ $payment->id }}</td>
                            <td>
                                <h6>{{ Carbon\Carbon::parse($payment->payment_time)->format('jS F,Y h:i:sA') }}</h6>
                            </td>
                            <td>
                                <h5>{{ $payment->client->name }}</h5>
                                <h6>Balance: <strong>KES {{ number_format($payment->client->balance, 2) }}</strong>
                                </h6>
                            </td>
                            <td>
                                <small>{{ $payment->transaction_reference }}</small>
                            </td>

                            <td>
                                @foreach ($payment->sales as $sale)
                                    <li>
                                        Sale No: #{{ $sale->id }} <br>
                                        KES {{ number_format($sale->total_paid, 2) }}
                                    </li>
                                @endforeach
                            </td>
                            <td>
                                KES {{ number_format($payment->amount, 2) }}
                            </td>

                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.sale-payments.edit', $payment->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button
                                    onclick="confirm('Are you sure you wish to delete this Sale Payment?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $payment->id }})'>
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
                        <td><strong>
                                KES
                                {{ number_format(
                                    $sales_payments->sum(function ($payment) {
                                        return $payment->sales->sum(function ($sale) {
                                            return $sale->pivot->amount;
                                        });
                                    }),
                                    2,
                                ) }}

                            </strong></td>
                        <td>
                            <strong>
                                KES
                                {{ number_format(
                                    $sales_payments->sum(function ($payment) {
                                        return $payment->amount;
                                    }),
                                    2,
                                ) }}
                            </strong>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>