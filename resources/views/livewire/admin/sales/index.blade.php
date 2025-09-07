<div>
    <x-slot:header>Sales</x-slot:header>
    @php
    $user = auth()->user();
    @endphp
    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Sales' list</h5>
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
                            <th>Ref Num</th>
                            <th>Sale Date</th>
                            <th>Bar Code</th>
                            <th>Product</th>

                            <th>No. of Unit Sold</th>
                            <th>Total Amount</th>


                            @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                            <th class="text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)  
                        <tr>
                            <td>ref num</td>
                            <td>
                                <h6>{{Carbon\Carbon::parse($sale->sale_date)->format('jS F,Y') }}</h6>
                            </td>
                            <td>|||||</td>
                            <td>alcohol</td>
                            <td> <small> {{ number_format($sale->total_quantity, 2)}}</small></td>
                            <td> <small>PISO {{ number_format($sale->total_amount, 2)}}</small></td>

                            <td class="text-center">
                                @if ($user && $user->hasPermission('edit permission'))

                                <a wire:navigate href="{{ route('admin.sales.edit', $sale->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @endif
                                @if ($user && $user->hasPermission('delete permission'))

                                <button
                                    onclick="confirm('Are you sure you wish to DELETE this Sale?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $sale->id }})'>
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
                            <td><strong>{{ number_format($sales->sum(function ($sale) {
    return $sale->total_quantity; })) }}</strong></td>
                            <td><strong> PISO {{ number_format($sales->sum(function ($sale) {
    return $sale->total_amount; })) }}</strong></td>
                            <td></td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>