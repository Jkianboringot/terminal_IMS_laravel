@props(['route'=>'null','title','bi_icon'=>'null','active'=> false])

<div>
      <li class="nav-item {{ request()->routeIs($route)||$active ? 'menu open':'' }}">
         <a wire:navigate href="{{ route($route) }}" class="nav-link {{ request()->routeIs()||$active?'active':'' }}" > 
        @if ($bi_icon)
        <i class="nav-icon bi {{ $bi_icon }}"></i>
        @endif

                                <p>
                                  
                                   
                                     {{$title}}
                                </p>
                            </a>
                          
                </li>
</div>

