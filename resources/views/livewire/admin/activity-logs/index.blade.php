<div>
  

    <input type="text" wire:model="search" class="form-control mb-3" placeholder="Search logs...">

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>User</th>
                <th>Action</th>
                <th>Model</th>
                <th>Model ID</th>
                <th>Changes</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr>
                <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                <td>{{ $log->user?->name ?? 'System' }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $log->action)) }}</td>
                <td>{{ $log->model }}</td>
                <td>{{ $log->model_id }}</td>
                <td>
                    @php
                    $changes = json_decode($log->changes, true);
                    @endphp

                    @if(is_array($changes) && count($changes) > 0)
                    @foreach($changes as $key => $value)
                    <strong>{{ ucfirst($key) }}:</strong> {{ $value }}<br>
                    @endforeach
                    @else
                    <em>No changes recorded</em>
                    @endif
                </td>

                <td>{{ $log->ip_address }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No logs found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $logs->links() }}
</div>