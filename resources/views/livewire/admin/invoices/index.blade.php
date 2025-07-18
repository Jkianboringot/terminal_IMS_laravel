<div>
    <x-slot:header>Invoices</x-slot:header>
    @php
    $user = auth()->user();
    @endphp
    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary binvoice-0">
            <h5>Invoices' list</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover  ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Invoice Date</th>
                        <th>Client</th>
                        <th>Total Amount</th>
                        <th>Status</th>

                        @if ($user && $user->hasPermission('edit permission') || $user->hasPermission('delete permission'))
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                        <td scope="row">{{ $invoice->id }}</td>
                        <td>
                            <h6>{{Carbon\Carbon::parse($invoice->client_id)->format('jS F,Y') }}</h6>
                        </td>
                        <td>{{ $invoice->client->name }}</td>
                        <td> <small>PISO {{ number_format($invoice->total_amount, 2)}}</small></td>
                        <td>
                            <span class={{ $invoice->is_paid ? 'text-success' : 'text-danger' }} style="font: bold">
                                {{ $invoice->is_paid ? 'Paid' : 'Not Paid' }}</span>
                        </td>
                        <td class="text-center">
                            @if ($user && $user->hasPermission('edit permission'))

                            <a wire:navigate href="{{ route('admin.invoices.edit', $invoice->id) }}"
                                class="btn btn-secondary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            @endif
                            @if ($user && $user->hasPermission('download permission'))

                            <a target="_blank" href="{{ route('admin.invoice-download',$invoice->id) }}"
                                class="btn btn-primary">
                                <i class="bi bi-file-earmark-arrow-down "></i>
                            </a>
                            @endif

                            @if ($user && $user->hasPermission('edit permission'))

                            <button
                                onclick="confirm('Are you sure you wish to DELETE this Invoice?')||event.stopImmediatePropagation()"
                                class="btn btn-danger" wire:click='delete({{ $invoice->id }})'>
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