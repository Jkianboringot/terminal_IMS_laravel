
@props(['header'])


<div>
    <x-slot:header>Product Categories</x-slot:header>

 <div class="card" tabindex="0" wire:keydown.escape="cancel">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>{{ $header }}</h5>
        </div>
      
        <div class="card-body">

            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input wire:model.live='category.name' type="text" class="form-control" name="name" id="name"
                    aria-describedby="" placeholder="Enter your category name" />
                @error('category.name')
                    <small id="" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

                <x-livewire.partials.save-buttons/>


        
        </div>
        </form>
    </div>
</div>