<li class="nav-item dropdown user-menu relative inline-block" @if (!$editing) wire:poll.1800s @endif>
    <!-- //change the poll for every update, this is mostly for other user like in here for evry 30mins they see 
    the new change in the notes -->
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <span class="d-none d-md-inline">
            Notes
            <span class="badge bg-danger ms-1">{{ $noteCount }}</span>
        </span>
    </a>

    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" style="max-height: 300px; overflow-y: auto;">
        @if ($editing)
            <li class="px-3 py-2">
                <textarea wire:model.defer="content" class="form-control form-control-sm" rows="2" placeholder="Write a note..."></textarea>
                <div class="mt-2 d-flex justify-content-between">
                    <button wire:click="save" class="btn btn-success btn-sm">Save</button>
                    <button wire:click="$set('editing', false)" class="btn btn-secondary btn-sm">Cancel</button>
                </div>
            </li>
        @else
            @forelse ($notes as $note)
                <li class="px-3 py-1 border-bottom">
                    <small class="text-muted d-block">{!! nl2br(e(Str::limit($note->content, 100))) !!}</small>
                </li>
            @empty
                <li class="px-3 py-2">
                    <small class="text-muted">No notes yet.</small>
                </li>
            @endforelse

            <li class="px-3 py-2 d-flex justify-content-between">
                <button wire:click="edit" class="btn btn-sm btn-outline-primary">Add Note</button>
                <button wire:click="deleteNote" class="btn btn-sm btn-outline-danger">Delete All</button>
            </li>
        @endif
    </ul>
</li>
