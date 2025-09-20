@props(['header','staticpermissions'])
<div
>
    <x-slot:header>Roles</x-slot:header>

    <div class="card"  tabindex="0" wire:keydown.escape="cancel" >
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>{{$header}}</h5>
        </div>
        <div class="card-body">
        <form 
    wire:submit.prevent="save" 
>
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
                        <label for="staticpermissions" class="form-label">Permission</label>
                        <select wire:model.live='selected_permissions'  class="form-select" >
                        <option value="null" selected>Select the Role Permission </option>
                        @foreach ($staticpermissions as $staticpermission )
                        <option value="{{$staticpermission}}">{{ $staticpermission }}</option>
                          @endforeach
                        </select>


                    </div>
                  
                </div>
            </div>





            <button onclick="confirm('Are you sure you wish to create this Role')||event.stopImmediatePropagation()"
                wire:click='save' class="btn btn-dark text-inv-secondary">Save</button>
        </div>
        </form>
    </div>
</div>