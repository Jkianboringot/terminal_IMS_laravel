<div>
    <x-slot:header>Clients</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Create a new Client</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input wire:model.live='client.name' type="text" class="form-control" name="name"
                            id="name" aria-describedby="name" placeholder="Enter your Client's Name" />
                        @error('client.name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input wire:model.live='client.email' type="email" class="form-control" name="email"
                            id="email" aria-describedby="email" placeholder="Enter your Client's Email Address" />
                        @error('client.email')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input wire:model.live='client.phone_number' type="text" class="form-control" name="phone_number"
                            id="phone_number" aria-describedby="phone_number" placeholder="Enter Phone Number" />
                        @error('client.phone_number')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="registration_number" class="form-label">Registration Number</label>
                        <input wire:model.live='client.registration_number' type="text" class="form-control"
                            name="nregistration_numberame" id="registration_number" aria-describedby=""
                            placeholder="Enter Business Registration Number" />
                        @error('client.registration_number')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="tax_id" class="form-label">Tax ID</label>
                        <input wire:model.live='client.tax_id' type="text" class="form-control" name="tax_id"
                            id="tax_id" aria-describedby="" placeholder="Enter Tax ID" />
                        @error('client.tax_id')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Physical Address</label>
                    <textarea wire:model.live='client.address' class="form-control" name="address" id="address" rows="3"></textarea>
                    @error('client.address')
                        <small id="" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

              
                <div class="mb-3">
                    <label for="account_number" class="form-label">Account Number</label>
                    <input wire:model.live='client.account_number' type="text" class="form-control" name="account_number"
                        id="account_number" aria-describedby="" placeholder="Enter Client's Account Number" />
                    @error('client.account_number')
                        <small id="" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>



            </div>



            <button onclick="confirm('Are you sure you wish to update this Client')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-secondary">Save</button>
        </div>
    </div>
</div>