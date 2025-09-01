<div>
    <x-slot:header>Products</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Edit Product</h5>
        </div>
        <div class="card-body">

            <div class="row">

                <!-- Product Category -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Product Category</label>
                        <select wire:model.lazy='product.product_category_id' class="form-select">
                            <option value="">Select Category</option>
                            @foreach ($productCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('product.product_category_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Product Brand -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Product Brand</label>
                        <select wire:model.lazy='product.brand_id' class="form-select">
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('product.brand_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Name -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input wire:model.lazy='product.name' type="text" class="form-control"
                               placeholder="Enter Product Name" />
                        @error('product.name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Location -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Shelf Location</label>
                        <input wire:model.lazy='product.location' type="text" class="form-control"
                               placeholder="Enter Product Shelf Location" />
                        @error('product.location')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Barcode -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Barcode</label>
                        <input wire:model.lazy='product.barcode' type="text" class="form-control"
                               placeholder="Enter Product Barcode" />
                        @error('product.barcode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Supplier -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Supplier</label>
                        <select wire:model.lazy='product.supplier_id' class="form-select">
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        @error('product.supplier_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="col-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea wire:model.lazy='product.description' class="form-control" rows="3"></textarea>
                    @error('product.description')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Manual Upload -->
                <div class="col-12 mb-3">
                    <label class="form-label">Manual</label>
                    <input wire:model.lazy='manual_image' type="file" class="form-control" />
                    @error('manual_image')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                @if($manual_image)
                    <div class="col-12 mb-3">
                        <img width="150px" class="img-fluid p-3 border border-secondary"
                             src="{{ $manual_image->temporaryUrl() }}">
                    </div>
                @endif

                <!-- Inventory Threshold -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Inventory Threshold</label>
                        <input wire:model.lazy='product.inventory_threshold' type="number" min="0" step="1"
                               class="form-control" placeholder="Minimum stock before alert" />
                        @error('product.inventory_threshold')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Unit -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Unit</label>
                        <select wire:model.lazy='product.unit_id' class="form-select">
                            <option value="">Select Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('product.unit_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Quantity -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input wire:model.lazy='product.quantity' type="number" min="0" step="0.1"
                               class="form-control" placeholder="Product quantity" />
                        @error('product.quantity')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Purchase Price -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Unit Cost</label>
                        <input wire:model.lazy='product.purchase_price' type="number" min="0" step="0.1"
                               class="form-control" placeholder="Purchase price" />
                        @error('product.purchase_price')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Sale Price -->
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="form-label">Selling Price</label>
                        <input wire:model.lazy='product.sale_price' type="number" min="0" step="0.1"
                               class="form-control" placeholder="Sale price" />
                        @error('product.sale_price')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>

            <button wire:click='save'
                    onclick="confirm('Are you sure you want to save changes?') || event.stopImmediatePropagation()"
                    class="btn btn-dark text-inv-secondary mt-3">
                Save
            </button>
        </div>
    </div>
</div>
