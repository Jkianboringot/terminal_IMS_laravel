<div>
    <x-slot:header>Units</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Edit Edit</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input wire:model.live='unit.name' type="text" class="form-control" name="name"
                            id="name" aria-describedby="name" placeholder="Enter your Unit's Name" />
                        @error('unit.name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
             
               

            </div>

            <button onclick="confirm('Are you sure you wish to update this Unit')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-secondary">Save</button>
        </div>
    </div>
</div>