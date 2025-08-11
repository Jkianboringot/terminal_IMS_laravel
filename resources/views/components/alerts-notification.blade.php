<li id="notifDropdownWrapper"
    class="nav-item user-menu relative"
    wire:poll.30s="loadNotifications"
    x-data="{ open: false, trigger: null }"
    x-init="trigger = $refs.toggle"
    @click.outside="open = false">
    <a href="#"
        class="nav-link"
        x-ref="toggle"
        @click.prevent="open = !open">
        <span class="d-none d-md-inline">
            Notifications
            <span class="badge bg-danger ms-1">
                {{ $notifications->count() }}
            </span>
        </span>
    </a>

    <template x-teleport="body">
        <div x-show="open"
            x-transition
            class="absolute bg-white border border-gray-300 rounded shadow-lg z-50"
            style="max-height: 300px; overflow-y: auto; min-width: 280px;"
            @click.stop
            x-bind:style="`
                position: absolute;
                top: ${trigger?.getBoundingClientRect().bottom + window.scrollY}px;
                left: ${trigger?.getBoundingClientRect().right - 280}px;
                width: 280px;
             `">

            {{-- Existing notifications --}}
            @forelse($notifications as $note)
            <div class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center">
             

            <small> {{ $note->product->name }}</small>
           <small >QTY:(<strong class="text-danger">{{ $note->product->quantity }}</strong>)</small>
            </div>
            @empty
            <div class="px-3 py-2 ">No notifications</div>
            @endforelse

            {{-- Low stock products --}}
            
            {{-- Actions --}}
            <!-- <div class="px-3 py-2 d-flex justify-content-between"> 
         
     <button wire:click.stop="deleteAllNotifications"
                        class="btn btn-sm btn-outline-danger">
                    Clear All
                </button>
              
          </div> -->
        </div>
    </template>
</li>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.hook('message.processed', (message, component) => {
            const notif = document.getElementById('notifDropdownWrapper');
            if (notif && notif.__x) {
                notif.__x.$data.open = true;
            }
        });
    });
</script>