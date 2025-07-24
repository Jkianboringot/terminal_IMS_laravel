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
    - look at the inspect fo that guy is he has 45 errors becuase i do and maybe thats the reason
    - idk what happen even when i go abck the thing is still broken evn the font is broken figure this out for one hour tommorow if cant fix forget about it the ui is not that important look at other system in real life its shit but funcitonal

    this problem can actually be solve by doing npm run dev and watch the terminal show what happend and double saving becuase the app does not allow you to run it when you have outdated dependencies


# later on if i encounter a problem trace it backt o me change branch because maybe i did something in the ui_fix branch that i did not save in this smallchanges but it should not be the case since i commited the process of my saving but am jsut confuse becuase i already fix the migration now its back to whtn it was before saving just letting you know that the latest if this break woulf be ui_fix and vid time stamp for is 3:40 to 4 thats wehre it left of so start their if this fuck up



# the mail trap is broken dont know exactly why but i know that its not the mailtrap fault so may in the code i can send a email thourgh tinker but not ui 
    -problem was the import i need it not import and the .evn password was wrong was not suppose to have*** just number
    - i also git rid of the change made by gpt ,and validate() was not the one that cause problem since it work now may it was and i jst change something by accident but it work not and the cause probably was .evn✔✔
    -everyhting work even new user log in of created✔✔✔✔

# email ui not showing it show create instead but fix not the backend edit.php was rendering view for create not edit
    public function render()
    {
        return view('livewire.admin.users.edit');->was create before
    }


# had a problem with brand logo not appearing and saing brands/ request not found but fix it myself it was just a naming conflict 
so change to point it to brands_logo/logos instead of brands/logos which laravel confuse brands to the brands/index.php since i chnage 
in the config file system   to this   'public' => [
            'driver' => 'local',
            'root' => public_path(),
            'url' => env('APP_URL'),
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],
        not like that before if the problem cam back check public if it has a brands folder if it does thats probabbly the cause so delete it

# product categories stop working for some reason even though it was workign just before i create products
    - i will fix this first before deling with product bit for now acutally do the product first becuase i wan to see if ther are connected somehow to learn i guess
    -i need to fix categories because it cant confirm wheteer products is correct or not if its broken so fix it probelm is in routing 
    it work before but when i implemented products it break for some reason


# navigation problem when ip is like this i cant move to toher menu http://127.0.0.1:8000/users/create but when its http://127.0.0.1:8000/users i can go other side so maybe something to do with navigation fix that


# the brand image is broken agian i think its becase of the quality yhe higher px it has the most likely it will not appear

# quotation was broken but fix now dont know why 

# sales count is broken but other is completely fine for some reason figure it out tommorow redo the vid

# sales update is broken for some reason so i will go bavk  a commit to see what happens


# something was wrong with the migration sales but its works though its just that i all defauldt to zero fro some reason


# roles is broken i need to do this before being able to do anything $role = \App\Models\Role::find(1);
$role->permissions = json_encode(['manage users', 'manage roles']); // or whatever the correct list is
$role->save();
 because it sets the permissions as null automatically

        --- cause of prblem mugth have been in the name of config.permission in named it permission no (sgit )
# fix git email dont waste time and not show what you done in github so fix that shit delete bigblackcock acocunt

    ok its fix now the fucking google account was supplose to be slyrics fucking waste

# working on permission now i wll just follow for now but i will change it to be simple fied later n



# the purchase and sales edit are still broken and have not yet been fix
        -- it start like that every sinve i add where you can see balance of and quantity of items for products


# from now on i need to understand what each shit is for becuase i need to createa doc for client so that they understand what the fuck happens not gause so  ye am fuck because eevn now idont understand shit


# function for taking all payment in purchase payment in allocated amount is broken becase it cant revcognize the current selected so you have to seelct other then reselect




### IMPORTANT FIx of edit in all:
-   just get rid of $this->validate as its the one casueing it and the attach and detacht try to replace it with somthing else, else just git rid of it for now
