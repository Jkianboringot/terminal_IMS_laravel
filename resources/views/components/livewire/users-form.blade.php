
@props(['header','roles'])
<div>
    <x-slot:head>Users</x-slot:head>

    <div wire:loading wire:target="save"
         class="position-fixed top-0 start-0 w-100 h-100 bg-white bg-opacity-50 d-flex justify-content-center align-items-center z-50">
        <div class="spinner-border text-inv-secondary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <span class="text-inv-secondary ms-3 fs-5">Creating user... Please wait</span>
    </div>

    <div class="card" wire:loading.class="opacity-50 pointer-events-none" wire:target="save">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>{{ $header }}</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input wire:model.live='user.name' type="text" class="form-control" name="name" id="name"
                               placeholder="Enter your User's Name" />
                        @error('user.name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input wire:model.live='user.email' type="email" class="form-control" name="email" id="email"
                               placeholder="Enter your User's Email Address" />
                        @error('user.email')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group mb-3">
                        <label for="Roles" class="form-label">Roles</label>
                        <select wire:model="selectedRoles"
                                multiple
                                class="form-select form-select-lg"
                                name="" id="">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button
                onclick="confirm('Are you sure you want to Create this user') || event.stopImmediatePropagation()"
                wire:click="save"
                wire:loading.attr="disabled"
                class="btn btn-dark text-inv-secondary"
            >
                <span wire:loading.remove wire:target="save">Save</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
        </div>
    </div>
</div>
