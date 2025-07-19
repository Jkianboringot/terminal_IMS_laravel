<div>
    <x-slot:head>Brands</x-slot:head>
    @php
    $user = auth()->user();
    @endphp
    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Brands List</h5>
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
                        <th class="text-center">Name</th>
                        <!-- <th>Logo</th> -->
                        @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-end">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                    <tr>
                        <td scope="row">{{ $brand->id }}</td>
                        <td class="text-center">{{ $brand->name }}</td>
                        <!-- <td>
                            <img
                                src="{{ $brand->logo_url }}"
                                width="60"
                                alt="Brand Logo"
                                style="cursor: pointer;"
                                data-bs-toggle="modal"
                                data-bs-target="#imageModal"
                                onclick="document.getElementById('modalImage').src='{{ $brand->logo_url }}'" />
                        </td> -->
                        <td class="text-end">

                            @if ($user && $user->hasPermission('edit permission'))
                            <a wire:navigate href="{{ route('admin.brands.edit', $brand->id) }}"
                                class="btn btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @endif
                            @if ($user && $user->hasPermission('delete permission'))

                            <button
                                onclick="confirm('Are you sure you wish to DELETE this Brand?')||event.stopImmediatePropagation()"
                                class="btn btn-danger" wire:click='delete({{ $brand->id }})'>
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Fullscreen Image Modal -->
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
<!-- #use gpt to on this so dont be confuse if i cant fix but -->