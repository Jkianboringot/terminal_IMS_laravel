<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <!-- Left-side nav -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>

        <!-- Right-side nav -->
        <ul class="navbar-nav ms-auto">

            <!-- Sticky Notes (Livewire) -->
            <li class="nav-item dropdown user-menu">
                @livewire('admin.sticky-notes.sticky-note-banner')
            </li>

             <li class="nav-item dropdown user-menu">
                @livewire('admin.notifications.alerts-notification')
            </li>


            
            <!-- User Account Dropdown -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <!-- Profile photo can go here -->
                    <span class="d-none d-md-inline">
                        {{ auth()->user()->name }}
                    </span>
                </a>



                
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-body">
                        <a href="{{ route('profile.show') }}" class="btn btn-default btn-flat">Profile</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="btn btn-default btn-flat float-end">Sign out</a>
                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
