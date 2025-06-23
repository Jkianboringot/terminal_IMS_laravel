<div>
    <x-slot:header>Product Categories</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Edit  Categories</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="product_category" class="form-label">Name</label>
                        <input wire:model.live='category.name' type="text" class="form-control" name="product_category"
                            id="product_category" aria-describedby="product_category" placeholder="Enter your Product Category's " />
                        @error('category.name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
             
               

            </div>
a
            <button onclick="confirm('Are you sure you wish to update this Product Category')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-secondary">Save</button>
        </div>
    </div>
</div>