<div>
    <x-slot:header>Purchases</x-slot:header>
    @php
    $user = auth()->user();
    @endphp
    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Purchases' list</h5>
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
                       
                        <th>Purchase Date</th>
                        <th>Supplier</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date Settled</th>
                        @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-center">Actions</th>
                        @endif



                        <!-- how about i make it check if it has a edit or delete only then is action permision allowed -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                    <tr>
                       
                        <td>
                            <h6>{{Carbon\Carbon::parse($purchase->purchase_date)->format('jS F,Y') }}</h6>
                        </td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td> <small>PISO {{ number_format($purchase->total_amount, 2)}}</small></td>
                        <td>
                            <span class={{ $purchase->is_paid ? 'text-success' : 'text-danger' }} style="font: bold">
                                {{ $purchase->is_paid ? 'Paid' : 'Not Paid' }}</span>
                        </td>
                        <td><p class="form-control-plaintext">{{ date('Y-m-d') }}</p></td>
                        <td class="text-center">


                            @if ($user && $user->hasPermission('edit permission'))
                            <a wire:navigate href="{{ route('admin.purchases.edit', $purchase->id) }}"
                                class="btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @endif
                            @if ($user && $user->hasPermission('delete permission'))
                            <button
                                onclick="confirm('Are you sure you wish to DELETE this Purchase?')||event.stopImmediatePropagation()"
                                class="btn btn-danger" wire:click='delete({{ $purchase->id }})'>
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
                        <td><strong>{{ number_format($purchases->sum(function($purchase){
                                return $purchase->total_quantity;})) }}</strong></td>
                        <td><strong> PISO {{ number_format($purchases->sum(function($purchase){
                                return $purchase->total_amount;})) }}</strong></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>