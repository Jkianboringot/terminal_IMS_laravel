<div>
    <x-slot:header>Roles</x-slot:header>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Edit Role</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Title</label>
                        <input wire:model.live='role.title' type="text" class="form-control" name="name"
                            id="name" aria-describedby="" placeholder="Enter your Role Title" />
                        @error('role.title')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="col-md-6 col-12">
                  <div class="mb-3">
                        <label for="statispermissions" class="form-label">Permission</label>
                        <select wire:model.live='selected_permissions'  class="form-select" >
                        <option value="null" selected>Select the Role Permission </option>
                        @foreach ($staticpermissions as $statispermission )
                        <option value="{{$statispermission}}">{{ $statispermission }}</option>
                          @endforeach
                        </select>


                    </div>
                  
                </div>



                
            </div>





            <button onclick="confirm('Are you sure you wish to create this Role')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-secondary">Save</button>
        </div>
    </div>
</div>