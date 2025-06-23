<div>
    <x-slot:header>Brands</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Create New Brand's</h5>
        </div>
        <div class="card-body">

            <div class="row">
          
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input wire:model.live='brand.name' type="text" class="form-control" name="name"
                            id="name" aria-describedby="name" placeholder="Enter your Brand's Name" />
                        @error('brand.name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
             
                <div class="mb-3">
                    <label for="" class="form-label">Logo</label>
                    <input
                    wire:model.live='image'
                        type="file"
                        class="form-control"
                    
                    
                    />
                     @error('brand.image')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                </div>
                @if($image)
                <div class="mb-3">
                    <img width="150px"  class="img-fluid p-3 border border-secondary" src="{{$image->temporaryUrl() }}" >
                </div>
                @endif
               

            

            <button onclick="confirm('Are you sure you wish to update this Brand')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-secondary">Save</button>
        </div>
    </div>
</div>