<div>
    <x-slot:header>Pending Edit Requests</x-slot:header>

    <div class="card">
        <div class="card-header bg-warning text-dark border-0">
            <h5>Edit Requests</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Requested By</th>
                        <th>Supplier</th>
                        <th>Proposed Changes</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingEdits as $edit)
                        <tr>
                            <td>{{ $edit->user->name }}</td>
                            <td>{{ $edit->addProduct->supplier->name }}</td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach(json_decode($edit->changes, true) as $field => $value)
                                        <li><strong>{{ ucfirst($field) }}:</strong> {{ $value }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-center">
                                <button wire:click="approve({{ $edit->id }})"
                                    class="btn btn-success btn-sm">
                                    <i class="bi bi-check-lg"></i> Approve
                                </button>

                                <button wire:click="reject({{ $edit->id }})"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-x-lg"></i> Reject
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No pending edit requests.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
