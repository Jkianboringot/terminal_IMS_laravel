<div class="sidebar-wrapper">
    <nav class="mt-2"> <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Initialization</li>

            <x-new-nav-link title="Dashboard" bi_icon="bi-speedometer" route="admin.dashboard" />
            @if (auth()->user()->hasPermission('manage roles')  )
            
            <x-new-nav-link-dropdown title="Roles" bi_icon="bi-shield-lock" route="admin.roles*">
                <x-new-nav-link title="Role List" bi_icon="" route="admin.roles.index" />
                <x-new-nav-link title="Create Role" bi_icon="" route="admin.roles.create" />
            </x-new-nav-link-dropdown>
    @endif
        
                      @if (auth()->user()->hasPermission('manage users')  )
            <x-new-nav-link-dropdown title="Users" bi_icon="bi-people" route="admin.users*">
                <x-new-nav-link title="User List" bi_icon="" route="admin.users.index" />
                <x-new-nav-link title="Create User" bi_icon="" route="admin.users.create" />
            </x-new-nav-link-dropdown>
    @endif
                      @if (auth()->user()->hasPermission('manage banks')  )

            <x-new-nav-link-dropdown title="Banks" bi_icon="bi-bank" route="admin.banks*">
                <x-new-nav-link title="Bank List" bi_icon="" route="admin.banks.index" />
                <x-new-nav-link title="Create Bank" bi_icon="" route="admin.banks.create" />
            </x-new-nav-link-dropdown>
    @endif

                      @if (auth()->user()->hasPermission('manage clients')  )

            <li class="nav-header">CRM</li>
            <x-new-nav-link-dropdown title="Clients" bi_icon="bi-person-badge" route="admin.clients*">
                <x-new-nav-link title="Client List" bi_icon="" route="admin.clients.index" />
                <x-new-nav-link title="Create Client" bi_icon="" route="admin.clients.create" />
            </x-new-nav-link-dropdown>
    @endif

                      @if (auth()->user()->hasPermission('manage suppliers')  )

            <x-new-nav-link-dropdown title="Suppliers" bi_icon="bi-truck-front" route="admin.suppliers*">
                <x-new-nav-link title="Supplier List" bi_icon="" route="admin.suppliers.index" />
                <x-new-nav-link title="Create Supplier" bi_icon="" route="admin.suppliers.create" />
            </x-new-nav-link-dropdown>
    @endif

            <li class="nav-header">Product Management</li>
                      @if (auth()->user()->hasPermission('manage units')  )
            
              <x-new-nav-link-dropdown title="Units" bi_icon="bi-box" route="admin.units*">
                <x-new-nav-link title="Units List" bi_icon="" route="admin.units.index" />
                <x-new-nav-link title="Create Units" bi_icon="" route="admin.units.create" />
            </x-new-nav-link-dropdown>
    @endif

                      @if (auth()->user()->hasPermission('manage brands')  )

            <x-new-nav-link-dropdown title="Brands" bi_icon="bi-tags" route="admin.brands*">
                <x-new-nav-link title="Brand List" bi_icon="" route="admin.brands.index" />
                <x-new-nav-link title="Create Brand" bi_icon="" route="admin.brands.create" />
            </x-new-nav-link-dropdown>
    @endif

                      @if (auth()->user()->hasPermission('manage product categories')  )

            <x-new-nav-link-dropdown title="Product Categories" bi_icon="bi-grid-1x2" route="admin.productcategories*">
                <x-new-nav-link title="Category List" bi_icon="" route="admin.productcategories.index" />
                <x-new-nav-link title="Create Category" bi_icon="" route="admin.productcategories.create" />
            </x-new-nav-link-dropdown>
    @endif

                      @if (auth()->user()->hasPermission('manage products')  )

            <x-new-nav-link-dropdown title="Products" bi_icon="bi-box" route="admin.products*">
                <x-new-nav-link title="Product List" bi_icon="" route="admin.products.index" />
                <x-new-nav-link title="Create Product" bi_icon="" route="admin.products.create" />
            </x-new-nav-link-dropdown>
    @endif


          <li class="nav-header">Accounting & Inventory</li>

          <x-new-nav-link title="OverView" bi_icon="bi-wallet" route="admin.accounts-summary" />
                      @if (auth()->user()->hasPermission('manage purchases')  )
          
            <x-new-nav-link-dropdown title="Purchases" bi_icon="bi-bag-check" route="admin.purchases*">
                <x-new-nav-link title="Purchase List" bi_icon="" route="admin.purchases.index" />
                <x-new-nav-link title="Create Purchase" bi_icon="" route="admin.purchases.create" />
            </x-new-nav-link-dropdown>
    @endif

                      @if (auth()->user()->hasPermission('manage sales')  )

              <x-new-nav-link-dropdown title="Sales" bi_icon="bi-bar-chart" route="admin.sales*">
                <x-new-nav-link title="Sales List" bi_icon="" route="admin.sales.index" />
                <x-new-nav-link title="Create Sale" bi_icon="" route="admin.sales.create" />
            </x-new-nav-link-dropdown>
    @endif


                      @if (auth()->user()->hasPermission('manage orders')  )

                <x-new-nav-link-dropdown title="Orders" bi_icon="bi-cart-check" route="admin.orders*">
                <x-new-nav-link title="Order List" bi_icon="" route="admin.orders.index" />
                <x-new-nav-link title="Create Order" bi_icon="" route="admin.orders.create" />
            </x-new-nav-link-dropdown>
    @endif

                      @if (auth()->user()->hasPermission('manage quotations')  )

            
            <x-new-nav-link-dropdown title="Quotations" bi_icon="bi-file-earmark-text" route="admin.quotations*">
                <x-new-nav-link title="Quotation List" bi_icon="" route="admin.quotations.index" />
                <x-new-nav-link title="Create Quotation" bi_icon="" route="admin.quotations.create" />
            </x-new-nav-link-dropdown>
    @endif

                      @if (auth()->user()->hasPermission('manage invoices')  )
 
             <x-new-nav-link-dropdown title="Invoices" bi_icon="bi-receipt" route="admin.invoices*">
                <x-new-nav-link title="Invoice List" bi_icon="" route="admin.invoices.index" />
                <x-new-nav-link title="Create Invoice" bi_icon="" route="admin.invoices.create" />
            </x-new-nav-link-dropdown>
    @endif

                      @if (auth()->user()->hasPermission('manage credit notes')  )

            <x-new-nav-link-dropdown title="Credit Notes" bi_icon="bi-journal-minus" route="admin.creditnotes*">
                <x-new-nav-link title="Credit Note List" bi_icon="" route="admin.creditnotes.index" />
                <x-new-nav-link title="Create Credit Note" bi_icon="" route="admin.creditnotes.create" />
            </x-new-nav-link-dropdown>
    @endif


                      @if (auth()->user()->hasPermission('manage delivery notes')  )

            <x-new-nav-link-dropdown title="Delivery Notes" bi_icon="bi-truck" route="admin.deliverynotes*">
                <x-new-nav-link title="Delivery Note List" bi_icon="" route="admin.deliverynotes.index" />
                <x-new-nav-link title="Create Delivery Note" bi_icon="" route="admin.deliverynotes.create" />
            </x-new-nav-link-dropdown>
    @endif


           
        

       

            



        </ul> <!--end::Sidebar Menu-->
    </nav>
</div> <!--end::Sidebar Wrapper-->