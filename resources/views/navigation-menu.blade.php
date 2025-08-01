<nav class="app-header navbar navbar-expand bg-body"> 
    <div class="container-fluid"> 
        <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i
                        class="bi bi-list"></i> </a> </li>
           
        </ul> 
        <ul class="navbar-nav ms-auto"> 
           


    <x-sticky-note-banner/>
            
        


            <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown">
                     <!-- <img src="{{auth()->user()->profile_photo_url}}"
                        class="user-image rounded-circle shadow" alt="User Image">
                        this get rid of profile pic at the header -->
                        
                        <span class="d-none d-md-inline">
                        {{ auth()->user()->name }}</span> </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                
                    <li class="user-body">
                        <a href="{{ route('profile.show') }}" class="btn btn-default btn-flat">Profile</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();"
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