@php
$user = auth()->user();
@endphp

<div class="sidebar-wrapper">
    <nav class="mt-2">
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Initialization</li>

            <x-new-nav-link title="Dashboard" bi_icon="bi-speedometer" route="admin.dashboard" />

            @if ($user && $user->hasPermission('manage roles'))
            <x-new-nav-link-dropdown title="Roles" bi_icon="bi-shield-lock" route="admin.roles*">
                <x-new-nav-link title="Role List" bi_icon="" route="admin.roles.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create Role" bi_icon="" route="admin.roles.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif

            @if ($user && $user->hasPermission('manage users'))
            <x-new-nav-link-dropdown title="Users" bi_icon="bi-people" route="admin.users*">
                <x-new-nav-link title="User List" bi_icon="" route="admin.users.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create User" bi_icon="" route="admin.users.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif

            @if ($user && $user->hasPermission('manage approvals'))
             <x-new-nav-link-dropdown title="Approvals" bi_icon="bi bi-clipboard2-check" route="admin.approvals*">
                    <x-new-nav-link title="Approvals List" bi_icon="" route="admin.approvals.addapproval" />
                  
                     
                    <x-new-nav-link title="Edited Approvals List" bi_icon="" route="admin.approvals.approvaledit" />
                </x-new-nav-link-dropdown>
   @endif

            @if ($user && $user->hasPermission('manage customers'))
            <li class="nav-header">CRM</li>
            <x-new-nav-link-dropdown title="Customers" bi_icon="bi-person-badge" route="admin.customers*">
                <x-new-nav-link title="Customer List" bi_icon="" route="admin.customers.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create Customer" bi_icon="" route="admin.customers.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif

            @if ($user && $user->hasPermission('manage suppliers'))
            <x-new-nav-link-dropdown title="Suppliers" bi_icon="bi-truck-front" route="admin.suppliers*">
                <x-new-nav-link title="Supplier List" bi_icon="" route="admin.suppliers.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create Supplier" bi_icon="" route="admin.suppliers.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif

            <li class="nav-header">Product Management</li>

            @if ($user && $user->hasPermission('manage units'))
            <x-new-nav-link-dropdown title="Units" bi_icon="bi-box" route="admin.units*">
                <x-new-nav-link title="Units List" bi_icon="" route="admin.units.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create Units" bi_icon="" route="admin.units.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif

            @if ($user && $user->hasPermission('manage brands'))
            <x-new-nav-link-dropdown title="Brands" bi_icon="bi-tags" route="admin.brands*">
                <x-new-nav-link title="Brand List" bi_icon="" route="admin.brands.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create Brand" bi_icon="" route="admin.brands.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif

            @if ($user && $user->hasPermission('manage product categories'))
            <x-new-nav-link-dropdown title="Product Categories" bi_icon="bi-grid-1x2" route="admin.productcategories*">
                <x-new-nav-link title="Category List" bi_icon="" route="admin.productcategories.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create Category" bi_icon="" route="admin.productcategories.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif

            @if ($user && $user->hasPermission('manage products'))
            <x-new-nav-link-dropdown title="Products" bi_icon="bi bi-boxes" route="admin.products*">
                <x-new-nav-link title="Product List" bi_icon="" route="admin.products.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create Product" bi_icon="" route="admin.products.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif

            <li class="nav-header">Accounting & Inventory</li>
            @if ($user && $user->hasPermission('manage product purchases'))
            <x-new-nav-link-dropdown title="Purchases" bi_icon="bi-bag-check" route="admin.purchases*">
                <x-new-nav-link title="Purchase List" bi_icon="" route="admin.purchases.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create Purchase" bi_icon="" route="admin.purchases.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif


            @if ($user && $user->hasPermission('manage add products'))
            <x-new-nav-link-dropdown title="New Arrival" bi_icon="bi bi-inboxes" route="admin.add-products*">
                <x-new-nav-link title="New Arrivals List" bi_icon="" route="admin.add-products.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create New Arrival" bi_icon="" route="admin.add-products.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif

  @if ($user && $user->hasPermission('manage unsuccessfull transactions'))
            <x-new-nav-link-dropdown title="Unsuccessful Transac" bi_icon="bi bi-window-x" route="admin.unsuccessful-transactions*">
                <x-new-nav-link title="Unsuccessful Transact List" bi_icon="" route="admin.unsuccessful-transactions.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create Unsuccessful Transact" bi_icon="" route="admin.unsuccessful-transactions.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif


            @if ($user && $user->hasPermission('manage sales'))
            <x-new-nav-link-dropdown title="Sales" bi_icon="bi-bar-chart" route="admin.sales*">
                <x-new-nav-link title="Sales List" bi_icon="" route="admin.sales.index" />
                @if ($user && $user->hasPermission('create permission'))
                <x-new-nav-link title="Create Sale" bi_icon="" route="admin.sales.create" />
                @endif
            </x-new-nav-link-dropdown>
            @endif


           
            @if ($user && $user->hasPermission('manage orders'))
                <x-new-nav-link-dropdown title="Orders" bi_icon="bi-cart-check" route="admin.orders*">
                    <x-new-nav-link title="Order List" bi_icon="" route="admin.orders.index" />
                    @if ($user && $user->hasPermission('create permission'))
                        <x-new-nav-link title="Create Order" bi_icon="" route="admin.orders.create" />
                    @endif
                </x-new-nav-link-dropdown>
            @endif

            @if($user && $user->hasPermission('manage returns'))
                <x-new-nav-link-dropdown title="Returns" bi_icon="bi bi-arrow-return-left" route="admin.returns*">
                    <x-new-nav-link title="Returns List" bi_icon="" route="admin.returns.index" />
                        <x-new-nav-link title="Create Returns" bi_icon="" route="admin.returns.create" />
                </x-new-nav-link-dropdown>
        @endif
                 
 {{--
            @if ($user && $user->hasPermission('manage quotations'))
                <x-new-nav-link-dropdown title="Quotations" bi_icon="bi-file-earmark-text" route="admin.quotations*">
                    <x-new-nav-link title="Quotation List" bi_icon="" route="admin.quotations.index" />
                    @if ($user && $user->hasPermission('create permission'))
                        <x-new-nav-link title="Create Quotation" bi_icon="" route="admin.quotations.create" />
                    @endif
                </x-new-nav-link-dropdown>
            @endif

            @if ($user && $user->hasPermission('manage invoices'))
                <x-new-nav-link-dropdown title="Invoices" bi_icon="bi-receipt" route="admin.invoices*">
                    <x-new-nav-link title="Invoice List" bi_icon="" route="admin.invoices.index" />
                    @if ($user && $user->hasPermission('create permission'))
                        <x-new-nav-link title="Create Invoice" bi_icon="" route="admin.invoices.create" />
                    @endif
                </x-new-nav-link-dropdown>
            @endif

            @if ($user && $user->hasPermission('manage payments'))
                <x-new-nav-link-dropdown title="SalePayments" bi_icon="bi-receipt" route="admin.sale-payments*">
                    <x-new-nav-link title="Sale Payments List" bi_icon="" route="admin.sale-payments.index" />
                    @if ($user && $user->hasPermission('create permission'))
                        <x-new-nav-link title="Create Sale Payment" bi_icon="" route="admin.sale-payments.create" />
                    @endif
                </x-new-nav-link-dropdown>
            @endif

            @if ($user && $user->hasPermission('manage payments'))
                <x-new-nav-link-dropdown title="PurchasePayments" bi_icon="bi-receipt" route="admin.purchase-payments*">
                    <x-new-nav-link title="Purchase Payments List" bi_icon="" route="admin.purchase-payments.index" />
                    @if ($user && $user->hasPermission('create permission'))
                        <x-new-nav-link title="Create Purchase Payment" bi_icon="" route="admin.purchase-payments.create" />
                    @endif
                </x-new-nav-link-dropdown>
            @endif --}}


        @if ($user && $user->hasPermission('manage activity logs'))

            <x-new-nav-link title="Activity Log" bi_icon="bi bi-clock-history" route="admin.activity-logs.index" />
            @endif

        </ul>
    </nav>
</div>


{{-- be added later on  --}}
{{-- @if ($user && $user->hasPermission('manage credit notes'))
                <x-new-nav-link-dropdown title="Credit Notes" bi_icon="bi-journal-minus" route="admin.creditnotes*">
                    <x-new-nav-link title="Credit Note List" bi_icon="" route="admin.creditnotes.index" />
                    @if ($user && $user->hasPermission('create permission'))
                        <x-new-nav-link title="Create Credit Note" bi_icon="" route="admin.creditnotes.create" />
                    @endif
                </x-new-nav-link-dropdown>
            @endif

            @if ($user && $user->hasPermission('manage delivery notes'))
                <x-new-nav-link-dropdown title="Delivery Notes" bi_icon="bi-truck" route="admin.deliverynotes*">
                    <x-new-nav-link title="Delivery Note List" bi_icon="" route="admin.deliverynotes.index" />
                    @if ($user && $user->hasPermission('create permission'))
                        <x-new-nav-link title="Create Delivery Note" bi_icon="" route="admin.deliverynotes.create" />
                    @endif
                </x-new-nav-link-dropdown>
            @endif --}}