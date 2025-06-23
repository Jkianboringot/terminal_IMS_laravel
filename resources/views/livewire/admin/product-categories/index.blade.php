<div>
    <x-slot:head>Product Categories</x-slot:head>


    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Product Categories List</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Number of Products</th>

                        
                        <th class="text-center">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($productCategories as $category)
                        <tr>
                            <td scope="row">{{ $category->id }}</td>
                            <td> {{ $category->name }}</td>
                            <td> {{ count($category->products) }}</td>
                            
                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.product-categories.edit', $category->id) }}"
                                    class="btn btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>

                                </a>
                                <a  class="btn btn btn-secondary">
                                    <i class="bi bi-trash-fill"></i>

                                </a>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>