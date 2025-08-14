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
                        <th>ID</th>
                        <th>Purchase Date</th>
                        <th>Supplier</th>
                        <th>Quantity Added</th>
                        
                     
                        @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-center">Actions</th>
                        @endif



                        <!-- how about i make it check if it has a edit or delete only then is action permision allowed -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addProducts as $addProduct)
                    <tr>
                        <td scope="row">{{ $addProduct->id }}</td>
                        <td>
                            <h6>{{Carbon\Carbon::parse($addProduct->purchase_date)->format('jS F,Y') }}</h6>
                        </td>
                        <td>{{ $addProduct->supplier->name }}</td>
                        <td> <small>{{ number_format($addProduct->total_quantity, 2)}}</small></td>
                    
                      
                        <td >
                            <a wire:navigate href="{{ route('admin.add-products.edit', $addProduct->id) }}"
                                class="btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                           
                            <button
                                onclick="confirm('Are you sure you wish to DELETE this Purchase?')||event.stopImmediatePropagation()"
                                class="btn btn-danger" wire:click='delete({{ $addProduct->id }})'>
                                <i class="bi bi-trash-fill">e</i>
                            </button>
                         
                        </td>

                    </tr>
                    @endforeach
                    <tr>
                        <td><strong>TOTAL QUANTITY</strong></td>
                        <td></td>
                        <td></td>
                         
                        <td><strong>{{ number_format($addProducts->sum(function($addProduct){
                                return $addProduct->total_quantity;})) }}</strong></td>
                       
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>