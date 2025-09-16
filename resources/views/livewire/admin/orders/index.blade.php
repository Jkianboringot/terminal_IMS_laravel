<div>
    <x-slot:header>Orders</x-slot:header>

    @php
    $user = auth()->user();
    @endphp
    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Orders' list</h5>
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
                            <th>Order Ref</th>
                            
                            <th>Order Date</th>
                            <th>Customer</th>
                            <th>Product</th>
                            {{-- <th>QTY</th> --}}
                            <th>Status</th>
                            <th>Total Amount</th>
                            <th>Delivery Date</th>
                            <!-- <th>Status</th> -->

                            @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                            <th class="text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->orders_ref }}</td>
                            <td>
                                {{Carbon\Carbon::parse($order->order_date)->format('jS F,Y') }}
                            </td>
                            <td>
                                {{ $order->customer->name }}

                            </td>
                            <td>
                                <small>
                                    @foreach($order->products as $product)
                                    {{ $product->name }}@if(!$loop->last), @endif
                                    @endforeach
                                </small>

                                {{-- <td>
                              <small>
                                    @foreach($order->products as $product)
                                    {{ $product->quantity }}@if(!$loop->last), @endif
                                @endforeach
                                </small>

                            </td> --}}
                        <td>{{ $order->order_status }}</td>
                            <td> PISO <strong> {{ number_format($order->total_amount, 2)}}</strong></td>
                            <!-- <td>
                                <span class={{ $order->is_paid ? 'text-success' : 'text-danger' }} style="font: bold">
                                {{ $order->is_paid ? 'Paid' : 'Not Paid' }}</span>
                            </td> -->
                            <td>
                              {{Carbon\Carbon::parse($order->delivery_date)->format('jS F,Y') }}
                            </td>
                            <td class="text-center">
                                @if ($user && $user->hasPermission('edit permission'))

                                <a wire:navigate href="{{ route('admin.orders.edit', $order->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @endif
                                @if ($user && $user->hasPermission('download permission'))

                                <a target="_blank" href="{{ route('admin.order-download',$order->id) }}"
                                    class="btn btn-primary">
                                    <i class="bi bi-file-earmark-arrow-down "></i>
                                </a>
                                @endif

                                @if ($user && $user->hasPermission('delete permission'))

                                <button
                                    onclick="confirm('Are you sure you wish to DELETE this Order?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $order->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>