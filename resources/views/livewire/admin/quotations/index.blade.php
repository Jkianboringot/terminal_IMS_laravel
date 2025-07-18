<div>
    <x-slot:header>Quotations</x-slot:header>

    @php
    $user = auth()->user();
    @endphp
    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary bquotation-0">
            <h5>Quotations' list</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Quotation Date</th>
                        <th>Client</th>
                        <th>Total Amount</th>
                        @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quotations as $quotation)
                    <tr>
                        <td scope="row">{{ $quotation->id }}</td>
                        <td>
                            <h6>{{ Carbon\Carbon::parse($quotation->quotation_date)->format('jS F,Y') }}</h6>
                        </td>
                        <td>
                            {{ $quotation->client->name }}
                        </td>
                        <td>
                            <small>PISO {{ number_format($quotation->total_amount, 2) }}</small>
                        </td>
                        {{-- <td>
                                <span class="{{ $quotation->is_paid ? 'text-success' : 'text-danger' }}"
                        style="font: bold">
                        {{ $quotation->is_paid ? 'Paid' : 'Not Paid' }}
                        </span>
                        </td> --}}
                        <td class="text-center">
                            @if ($user && $user->hasPermission('edit permission'))

                            <a href="{{ route('admin.quotations.edit', $quotation->id) }}"
                                class="btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @endif
                            @if ($user && $user->hasPermission('download permission'))
                            
                            <a target="_blank" href="{{ route('admin.quotation-download', $quotation->id) }}" class="btn btn-primary">
                                <i class="bi bi-file-earmark-arrow-down"></i>
                            </a>
                            @endif
                            @if ($user && $user->hasPermission('delete permission'))

                            <button
                                onclick="confirm('Are you sure you wish to delete this Quotation?')||event.stopImmediatePropagation()"
                                class="btn btn-danger" wire:click='delete({{ $quotation->id }})'>
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>