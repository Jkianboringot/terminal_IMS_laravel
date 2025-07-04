<div>
    <x-slot:head>Brands</x-slot:head>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Brands List</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td scope="row">{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>
                                <img
                                    src="{{ $brand->logo_url }}"
                                    width="60"
                                    alt="Brand Logo"
                                    style="cursor: pointer;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#imageModal"
                                    onclick="document.getElementById('modalImage').src='{{ $brand->logo_url }}'"
                                />
                            </td>
                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.brands.edit', $brand->id) }}"
                                   class="btn btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                               <button
                                    onclick="confirm('Are you sure you wish to DELETE this Brand?')||event.stopImmediatePropagation()"
                                    class="btn btn-danger" wire:click='delete({{ $brand->id }})'>
                                    <i class="bi bi-trash-fill"></i>
                                </button>
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
                                data-bs-dismiss="modal"
                            />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- #use gpt to on this so dont be confuse if i cant fix but -->