@if ($editing)
    <div class="bg-yellow-100 p-4 text-black">
        <textarea wire:model="content" class="w-full p-2 border rounded"></textarea>
        <div class="mt-2">
            <button wire:click="save" class="bg-green-500 text-white px-3 py-1 rounded">Save</button>
            <button wire:click="deleteNote" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
        </div>
    </div>
@elseif ($content)
    <div class="bg-yellow-200 p-4 text-black flex justify-between items-center">
        <div>{{ $content }}</div>
        @if (auth()->check() && auth()->user()->is_admin)
            <button wire:click="edit" class="text-blue-500 underline ml-4">Edit</button>
        @endif
    </div>
@endif
