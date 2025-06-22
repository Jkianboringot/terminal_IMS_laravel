<div>
    <x-slot:head>Users</x-slot:head>

    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <!-- bg-inv-secondary was suppose to be bg-inv-primary 
                                                        but i change becuase thats my config -->
            <h5>Edit User</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input wire:model.live='user.name' type="text" class="form-control" name="name" id="name" aria-describedby=""
                            placeholder="Enter your User's Name" />
                        @error('user.name')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input wire:model.live='user.email' type="email" class="form-control" name="email" id="email"
                            aria-describedby="" placeholder="Enter your User's Email Address" />
                        @error('user.email')
                            <small id="" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
            </div>
            <button onclick="confirm('Are you sure you want to Create this user')||event.stopImmediatePropagation()" wire:click="save" class="btn btn-dark text-inv-secondary">Save</button>
        </div>
    </div>
</div>