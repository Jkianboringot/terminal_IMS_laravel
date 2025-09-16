<div>
    <x-slot:header>Returns</x-slot:header>

    @php $user = auth()->user(); @endphp

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Returns List</h5>
        </div>
        <div class="card-body table-responsive">

            <input type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search by reason or type..."
                class="form-control mb-3 @if($search) border border-primary @endif">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Return Ref</th>
                        <th>Return Type</th>
                        <th>Date</th>
                        <th>Products</th>
                        <th>Reason</th>
                        <th>Total Qty</th>
                        <th>Total Amount</th>
                        @if ($user && ($user->hasPermission('edit permission') || $user->hasPermission('delete permission')))
                            <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($returns as $return)
                        <tr>
                            <td>{{ $return->id }}</td>
                            <td>{{ ucfirst($return->return_type) }}</td>
                            <td>{{ \Carbon\Carbon::parse($return->return_date)->format('jS F, Y') }}</td>
                            <td>
                                <small>
                                    @foreach($return->products as $product)
                                        {{ $product->name }}@if(!$loop->last), @endif
                                    @endforeach
                                </small>
                            </td>
                            <td>{{ $return->reason }}</td>
                            <td>{{ $return->products->sum(fn($p) => $p->pivot->quantity) }}</td>
                            <td>PISO {{ number_format($return->products->sum(fn($p) => $p->pivot->quantity * $p->pivot->unit_price), 2) }}</td>

                            @if ($user && ($user->hasPermission('edit permission') || $user->hasPermission('delete permission')))
                                <td class="text-center">
                                    @if ($user->hasPermission('edit permission'))
                                        <a wire:navigate href="{{ route('admin.returns.edit', $return->id) }}"
                                            class="btn btn-secondary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    @endif
                                    @if ($user->hasPermission('delete permission'))
                                        <button onclick="confirm('Delete this return?')||event.stopImmediatePropagation()"
                                            class="btn btn-danger"
                                            wire:click='delete({{ $return->id }})'>
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $returns->links() }}
        </div>
    </div>
</div>
