@props(['content', 'editing'])

<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <span class="d-none d-md-inline">Notes</span>
    </a>

    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        @if ($editing)
            <li class="user-header bg-warning">
                <textarea wire:model.defer="content" class="form-control" rows="3"></textarea>
            </li>
            <li class="user-footer">
                <button wire:click="save" class="btn btn-success btn-flat">Save</button>
                <button wire:click="$set('editing', false)" class="btn btn-secondary btn-flat float-end">Cancel</button>
            </li>
        @else
            <li class="user-header bg-warning">
                <p class="text-dark m-0">
                    {!! nl2br(e($content)) !!}
                </p>
            </li>
            <li class="user-footer">
                <button wire:click="edit" class="btn btn-default btn-flat">Edit Notes</button>
                <button wire:click="deleteNote" class="btn btn-danger btn-flat float-end">Delete</button>
            </li>
        @endif
    </ul>
</li>
