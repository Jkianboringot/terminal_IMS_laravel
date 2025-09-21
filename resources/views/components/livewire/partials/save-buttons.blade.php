
<button onclick="if(!confirm('Are you sure you wish to Proceed')){event.stopImmediatePropagation(); return false;}"
                    wire:click="save" class="btn btn-dark text-inv-secondary">Save</button>