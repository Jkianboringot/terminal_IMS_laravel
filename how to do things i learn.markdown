# add profile pic or delete accout

    -if you want to have delete account or just control the profile part go to config/jetstream Feature and comment and uncomment things there

php artisan make:livewire Admin/Dashboard
php artisan make:livewire Admin/Users/Index
php artisan make:livewire Admin/Users/Create
php artisan make:livewire Admin/Users/Edit

php artisan make:livewire Admin/Roles/Index
php artisan make:livewire Admin/Roles/Create
php artisan make:livewire Admin/Roles/Edit

php artisan make:livewire Admin/Banks/Index
php artisan make:livewire Admin/Banks/Create
php artisan make:livewire Admin/Banks/Edit

php artisan make:livewire Admin/Clients/Index
php artisan make:livewire Admin/Clients/Create
php artisan make:livewire Admin/Clients/Edit

php artisan make:livewire Admin/Suppliers/Index
php artisan make:livewire Admin/Suppliers/Create
php artisan make:livewire Admin/Suppliers/Edit

php artisan make:livewire Admin/Brands/Index
php artisan make:livewire Admin/Brands/Create
php artisan make:livewire Admin/Brands/Edit

php artisan make:livewire Admin/Units/Index
php artisan make:livewire Admin/Units/Create
php artisan make:livewire Admin/Units/Edit

php artisan make:livewire Admin/ProductCategories/Index
php artisan make:livewire Admin/ProductCategories/Create
php artisan make:livewire Admin/ProductCategories/Edit

php artisan make:livewire Admin/Products/Index
php artisan make:livewire Admin/Products/Create
php artisan make:livewire Admin/Products/Edit

php artisan make:livewire Admin/Purchases/Index
php artisan make:livewire Admin/Purchases/Create
php artisan make:livewire Admin/Purchases/Edit


php artisan make:livewire Admin/Sales/Index
php artisan make:livewire Admin/Sales/Create
php artisan make:livewire Admin/Sales/Edit

php artisan make:livewire Admin/Quotations/Index
php artisan make:livewire Admin/Quotations/Create
php artisan make:livewire Admin/Quotations/Edit

php artisan make:livewire Admin/DeliveryNotes/Index
php artisan make:livewire Admin/DeliveryNotes/Create
php artisan make:livewire Admin/DeliveryNotes/Edit


php artisan make:livewire Admin/Orders/Index
php artisan make:livewire Admin/Orders/Create
php artisan make:livewire Admin/Orders/Edit

php artisan make:livewire Admin/CreditNotes/Index
php artisan make:livewire Admin/CreditNotes/Create
php artisan make:livewire Admin/CreditNotes/Edit

php artisan make:livewire Admin/Invoices/Index
php artisan make:livewire Admin/Invoices/Create
php artisan make:livewire Admin/Invoices/Edit


after all this make sure to fix this type of thing      
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

                all that name tax_id was name i needs to be tax_id becuase itmight cause bag or in my case a minor problem were thigns that are thier are not their
                    thing that is suppose to be thier are not their

# turn the delete button to butotn to turn it red