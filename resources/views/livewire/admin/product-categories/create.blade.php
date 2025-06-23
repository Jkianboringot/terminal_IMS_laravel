<div>
    <x-slot:header>Product Categories</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Create New Product Categories</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="product_category" class="form-label">Category Name</label>
                        <input wire:model.live='category.name' type="text" class="form-control" name="product_category"
                            id="product_category" aria-describedby="name" placeholder="Enter your Product Categories Name" />
                        @error('category.name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
             
               

            </div>

            <button onclick="confirm('Are you sure you wish to update this Product Category')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-secondary">Save</button>
        </div>
    </div>
</div>