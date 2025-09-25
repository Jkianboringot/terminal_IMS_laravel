<div>
    <x-slot:header>Add Product</x-slot:header>
    @php
    $user = auth()->user();
    @endphp
    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Add Product list</h5>
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

                            <th>Product Added Date</th>
                            <th>Product</th>

                            <th>Quantity Added</th>


                            @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                            <th class="text-center">Actions</th>
                            @endif



                            <!-- how about i make it check if it has a edit or delete only then is action permision allowed -->
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($unsuccessfulTransactions as $unsuccessfulTransaction)
                        <tr>

                            <td>
                                <h6>{{ \Carbon\Carbon::parse($unsuccessfulTransaction->add_product_date)->format('jS F, Y') }}</h6>
                            </td>
                            <td>
                                <p>Products:
                                    @foreach($unsuccessfulTransaction->products as $product)
                                    {{ $product->name }}@if(!$loop->last), @endif
                                    @endforeach
                                </p>
                            </td>
                            <td><small>{{ number_format($unsuccessfulTransaction->total_quantity, 2) }}</small></td>



                            <td>
                                <a wire:navigate href="{{ route('admin.add-products.edit', $unsuccessfulTransaction->id) }}"
                                    class="btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <button
                                    onclick="confirm('Are you sure you wish to DELETE this Purchase?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $unsuccessfulTransaction->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </td>

                        </tr>
                        @endforeach
                        <tr>
                            <td><strong>TOTAL QUANTITY</strong></td>
                            <td></td>
                            <td></td>

                            <td><strong>{{ number_format($unsuccessfulTransactions->sum(function($unsuccessfulTransaction){
                                return $unsuccessfulTransaction->total_quantity;})) }}</strong></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>