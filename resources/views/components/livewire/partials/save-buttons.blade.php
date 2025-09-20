@props(['message'])

<button onclick="if(!confirm('{{$message}}')){event.stopImmediatePropagation(); return false;}"
                    wire:click="save" class="btn btn-dark text-inv-secondary">Save</button>