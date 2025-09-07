<li id="notifDropdownWrapper"
    class="nav-item user-menu relative"
    @if (!$editing) wire:poll.1800s @endif
    x-data="{ open: false, trigger: null }"
    x-init="trigger = $refs.toggle"
    @click.outside="open = false">
    <a href="#"
        class="nav-link"
        x-ref="toggle"
        @click.prevent="open = !open">
        <span class="d-none d-md-inline"><i class="bi bi-card-list text-danger"></i>
            Reminder
            <span class="badge bg-danger ms-1">{{ $noteCount }}</span>
        </span>
    </a>

    <!-- Teleport dropdown to body so it doesn't push navbar -->
    <template x-teleport="body">
        <div x-show="open"
            x-transition
            class="absolute bg-white border border-gray-300 rounded shadow-lg z-50"
            style="max-height: 300px; overflow-y: auto;"
            @click.stop
            x-bind:style="`
                position: absolute;
                top: ${trigger?.getBoundingClientRect().bottom + window.scrollY}px;
                left: ${trigger?.getBoundingClientRect().right - 256}px;
                width: 256px;
             `">
            @if ($editing)
            <div class="px-3 py-2">
                <textarea wire:model.defer="content"
                    class="form-control form-control-sm"
                    rows="2"
                    placeholder="Write a note..."></textarea>

                @error('content')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
                <div class="mt-2 d-flex justify-content-between">
                    <button wire:click.stop="save" class="btn btn-success btn-sm">Save</button>
                    <button wire:click.stop="$set('editing', false)" class="btn btn-secondary btn-sm">Cancel</button>
                </div>
            </div>
            @else
            @forelse ($notes as $note)
            <div class="px-3 py-1 border-bottom mt-2">
                <span class="text-muted d-block text-inv-secondary" style="color:red">
                    {!! nl2br(e(Str::limit($note->content, 100))) !!}
                </span>
                <div class="px-3 py-2 d-flex justify-content-end gap-2">
                    <button wire:click.stop="edit({{ $note->id }})"
                        class="btn btn-outline-primary btn-sm py-0 px-1">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button wire:click.stop="deleteNote({{ $note->id }})"
                        class="btn btn-outline-danger btn-sm py-0 px-1">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>


                <!-- fix the logic for this in back end edit should be able to edit note although i dont need this its fine to do this 
                                own your own as practice,add to this that it cannot be empty the input i mena it should ignore teh add if their is no input -->
            </div>
            @empty
            <div class="px-3 py-2">
                <span class="text-muted">No notes yet.</span>

            </div>
            @endforelse

            <div class="px-3 py-2 d-flex justify-content-between">
                <button wire:click.stop="addNote" class="btn btn-sm btn-outline-primary">
                    Add Note
                </button>
                <button wire:click.stop="deleteAllNote" class="btn btn-sm btn-outline-danger">
                    Delete All
                </button>
            </div>
            @endif
        </div>
    </template>
</li>