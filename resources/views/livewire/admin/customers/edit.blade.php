<div>
    <x-slot:header>Customers</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Edit Customer</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input wire:model.live='customer.name' type="text" class="form-control" name="name"
                            id="name" aria-describedby="name" placeholder="Enter your Customer's Name" />
                        @error('customer.name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Email Address</label>
                        <input wire:model.live='customer.email' type="email" class="form-control" name="email"
                            id="name" aria-describedby="email" placeholder="Enter your Customer's Email Address" />
                        @error('customer.email')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input wire:model.live='customer.phone_number' type="text" class="form-control" name="phone_number"
                            id="phone_number" aria-describedby="phone_number" placeholder="Enter Phone Number" />
                        @error('customer.phone_number')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                 <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="organization_type" class="form-label">Organization Type</label>
                        <select wire:model.live='customer.organization_type'  class="form-select" >
                        <option value="" selected>Select the Organization Type</option>
                        @foreach ($organization_types as $organization_type )
                        <option value="{{$organization_type}}">{{ $organization_type }}</option>
                          @endforeach
                        </select>
                      
            
                        @error('customer.organization_type')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="tax_id" class="form-label">TIN ID</label>
                        <input wire:model.live='customer.tax_id' type="text" class="form-control" name="tax_id"
                            id="tax_id" aria-describedby="" placeholder="Enter Tax ID" />
                        @error('customer.tax_id')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Physical Address</label>
                    <textarea wire:model.live='customer.address' class="form-control" name="address" id="address" rows="3"></textarea>
                    @error('customer.address')
                        <small id="" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

             v>



            </div>



            <button onclick="confirm('Are you sure you wish to update this Customer')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-secondary">Save</button>
        </div>
    </div>
</div>