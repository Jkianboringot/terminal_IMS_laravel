<div>
    <x-slot:head>Banks</x-slot:head>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">

            <h5>Edit Banks</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 cole-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input wire:model.Live='bank.name' type="text" class="form-control" name="name" id="name"
                            aria-describedby="" placeholder="Enter Bank Name" />
                        @error('bank.name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="col-md-4 cole-12">

                    <div class="mb-3">
                        <label for="name" class="form-label">Short Name</label>
                        <input wire:model.Live='bank.short_name' type="text" class="form-control" name="name" id="name"
                            aria-describedby="" placeholder="Enter Bank Short Name" />
                        @error('bank.short_name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="col-md-4 cole-12">

                    <div class="mb-3">
                        <label for="name" class="form-label">Code</label>
                        <input wire:model.Live='bank.sort_code' type="text" class="form-control" name="name" id="name"
                            aria-describedby="" placeholder="Enter Bank Sort Code" />
                        @error('bank.sort_code')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
            </div>
            <button onclick="confirm('Are you sure you want to Create this bank')||event.stopImmediatePropagation()"
                wire:click="save" class="btn btn-dark text-inv-secondary">Save</button>
        </div>
    </div>
</div>