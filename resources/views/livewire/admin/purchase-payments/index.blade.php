<div>
    <x-slot:header>Purchase Payments</x-slot:header>
    @php
    $user = auth()->user();
    @endphp
    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Purchase Payments' list</h5>
        </div>
        <div class="card-body table-responsive">
               <div class="card-body table-responsive">
                <input type="text"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Search by product name..."
                   class="form-control mb-3 @if($search) border border-primary @endif">

            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Date & Time</th>
                        <th>Supplier</th>
                        <th>Transaction Reference</th>
                        <th>Attached Purchases</th>
                        <th>Amount paid</th>
                        @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchase_payments as $payment)
                    <tr>
                        <td scope="row">{{ $payment->id }}</td>
                        <td>
                            <h6>{{ Carbon\Carbon::parse($payment->payment_time)->format('jS F,Y h:i:sA') }}</h6>
                        </td>
                        <td>
                            <h5>{{ $payment->supplier->name }}</h5>
                            <h6>Balance: <strong>PISO {{ number_format($payment->supplier->balance, 2) }}</strong>
                            </h6>
                        </td>
                        <td>
                            <small>{{ $payment->transaction_reference }}</small>
                        </td>

                        <td>
                            @foreach ($payment->purchases as $purchase)
                            <li>
                                Purchase No: #{{ $purchase->id }} <br>
                                PISO {{ number_format($purchase->total_paid, 2) }}
                            </li>
                            @endforeach
                        </td>
                        <td>
                            PISO {{ number_format($payment->amount, 2) }}
                        </td>

                        <td class="text-center">
                            @if ($user && $user->hasPermission('edit permission'))

                            <a wire:navigate href="{{ route('admin.purchase-payments.edit', $payment->id) }}"
                                class="btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @endif
                            @if ($user && $user->hasPermission('delete permission'))

                            <button
                                onclick="confirm('Are you sure you wish to delete this Purchase Payment?')||event.stopImmediatePropagation()"
                                class="btn btn-danger" wire:click='delete({{ $payment->id }})'>
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td><strong>TOTALS</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>
                                PISO
                                {{ number_format(
                                    $purchase_payments->sum(function ($payment) {
                                        return $payment->purchases->sum(function ($purchase) {
                                            return $purchase->pivot->amount;
                                        });
                                    }),
                                    2,
                                ) }}

                            </strong></td>
                        <td>
                            <strong>
                                PISO
                                {{ number_format(
                                    $purchase_payments->sum(function ($payment) {
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
</div>