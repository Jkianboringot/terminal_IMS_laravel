# if i got error probly because i miss up by undoing so go back to the vid in 30  to 45 mins
    - migth have problem with navigation
    
# change app.scss to @use instead of @import

# change app.scss cause vite manifiest

# change this line 15 in welcome.blade
     <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/sass/app.scss', 'resources/js/app.js'])

# config/jetstream.php feature is not working even if i change shit probably has somehting to do with other file, problem might be though to the app.scss


# i need to becarefull with git becuase it automatically pulls when i change branch

# sign out for navigation its not working ✔✔✔ this is fix i just need to change the web.php route to redirect dashboard


# there is something wrong with the image profile and its not the size i think its anout rendering

# shut donw mylaptop now the login is broken even know it work before didnt change anything✔✔✔
    - never mind fix now i just have to wait, probably the config is not set yet so maybe thats why

# if something broke in the backen probably because of this database design which i did kinda worng where products has no s and i just rename it with one

database design: refine it more 
php artisan make:model Role -m
php artisan make:model User -m
php artisan make:model Bank -m
php artisan make:model Client -m
php artisan make:model Supplier -m
php artisan make:model Brands -m
php artisan make:model Unit -m
php artisan make:model ProductCategory -m
php artisan make:model Product -m
php artisan make:model Purchase -m


php artisan make:model Sales -m
php artisan make:migration CreateProductSaleTable
php artisan make:model Quotation -m
php artisan make:model Order -m
php artisan make:model DeliveryNote -m
php artisan make:model CreditNote -m
php artisan make:model Invoice -m


mine:
php artisan make:model Role -m
php artisan make:model User -m  
php artisan make:model Bank -m
php artisan make:model Client -m
php artisan make:model Supplier -m
php artisan make:model Brands -m
php artisan make:model Unit -m
php artisan make:model ProductCategory -m
php artisan make:model Product -m
php artisan make:model Purchase -m
php artisan make:migration CreateProductTable
php artisan make:model Sales -m
php artisan make:migration CreateSalesTable
php artisan make:model Warehouses -m
php artisan make:model Order -m
php artisan make:model DeliveryNote -m
php artisan make:model Product_Stock	 -m
php artisan make:model Invoice -m



# the layouts like hover and change background of text does not work maybe i just need to wait before it work like last time with the profile and delete acc but one thing the bg_secondary does not work even though it work before when i plau with it so something is wrong that i did back then

# something definetely gone wrong as even the background dissapear for some reason, i thinks its becuse of the new shit i put i will try getting rid of it and puuitng it back but i will commmit first
    -ok the new add is not the problems maybe even later than that is