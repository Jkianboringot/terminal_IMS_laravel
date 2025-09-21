<button
        onclick="confirm('Are you sure you wish to cancel?')||event.stopImmediatePropagation()"
                            wire:click='cancel'
                            class="btn btn-outline-secondary flex-fill">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </button>