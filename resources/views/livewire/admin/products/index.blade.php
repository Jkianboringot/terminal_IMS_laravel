<div>
    <x-slot:header>Products</x-slot:header>
    @php
    $user = auth()->user();
    @endphp
    <div class="card">
        <div class="card-header bg-inv-secondary text-inv-primary border-0">
            <h5>Products' list</h5>
        </div>

        <div class="card-body table-responsive">
            <input type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search by product name..."
                class="form-control mb-3 @if($search) border border-primary @endif">

            <table class="table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Product Details</th>
                        <th>Category</th>
                        <th>Suplies Category</th>
                        <th>Measurement</th>
                        <th>Inventory Balance</th>
                        <th>Manual</th>

                        @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @if ($search && $products->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No products found for "{{ $search }}"</td>
                    </tr>
                    @elseif ($products->isNotEmpty())
                    @foreach ($products as $product)
                    <tr>
                        <td scope="row">{{ $product->id }}</td>
                        <td>
                            <h6>{{ $product->name }}</h6>
                            <small>{{ $product->description }}</small>
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->supplier->name }}</td>

                        <td>{{ $product->quantity . ' ' . $product->unit->name }}</td>
                        <td>{{ $product->inventory_balance }}</td>
                        <td>
                              @if ($product->manual_url)
                            <img
                                src="{{ $product->manual_url }}"
                                width="60"
                                alt="Brand Logo"
                                style="cursor: pointer;"
                                data-bs-toggle="modal"
                                data-bs-target="#imageModal"
                                onclick="document.getElementById('modalImage').src='{{ $product->manual_url }}'" />
                                  @endif
                        </td>
                        <td class="text-center">
                            @if ($user && $user->hasPermission('edit permission'))

                            <a wire:navigate href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @endif
                            
            

                            @if ($user && $user->hasPermission('delete permission'))

                            <button onclick="confirm('Are you sure you wish to DELETE this product?')||event.stopImmediatePropagation()" class="btn btn-danger" wire:click='delete({{ $product->id }})'>
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content bg-black border-0">
                <div class="modal-body d-flex justify-content-center align-items-center p-0" style="height: 100vh;">
                    <img
                        id="modalImage"
                        src=""
                        alt="Enlarged Image"
                        style="
                                    display: block;
                                    width: 100vw;
                                    max-width: 100vw;
                                    max-height: 95vh;
                                    object-fit: contain;
                                    cursor: pointer;
                                "
                        data-bs-dismiss="modal" />
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>