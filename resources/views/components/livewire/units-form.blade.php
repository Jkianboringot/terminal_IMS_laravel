
@props(['header'])

<div>
    <x-slot:header>Units</x-slot:header>

    <div class="card" tabindex="0" wire:keydown.escape="cancel">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>{{ $header }}</h5>
        </div>
        <form   wire:submit.prevent="save">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Unit Name</label>
                        <input wire:model.live='unit.name' type="text" class="form-control" name="name"
                            id="name" aria-describedby="" placeholder="Enter your Unit Name" />
                        @error('unit.name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="symbol" class="form-label">Unit Symbol</label>
                        <input wire:model.live='unit.symbol' type="text" class="form-control" name="symbol"
                            id="symbol" aria-describedby="" placeholder="Enter your Unit symbol" />
                        @error('unit.symbol')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>



            <button onclick="confirm('Are you sure you wish to create this Unit')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-secondary">Save</button>
        </div>
        </form>
    </div>
</div>