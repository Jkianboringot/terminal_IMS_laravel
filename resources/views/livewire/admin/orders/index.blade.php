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
                        <th>ID</th>
                        <th>Order Date</th>
                        <th>Supplier</th>
                        <th>Total Amount</th>
                        <!-- <th>Status</th> -->

                        @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td scope="row">{{ $order->id }}</td>
                        <td>
                            <h6>{{Carbon\Carbon::parse($order->order_date)->format('jS F,Y') }}</h6>
                        </td>
                        <td>{{ $order->supplier->name }}</td>
                        <td> <small>PISO {{ number_format($order->total_amount, 2)}}</small></td>
                        <!-- <td>
                                <span class={{ $order->is_paid ? 'text-success' : 'text-danger' }} style="font: bold">
                                {{ $order->is_paid ? 'Paid' : 'Not Paid' }}</span>
                            </td> -->
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