<div>
    <x-slot:head>Clients</x-slot:head>


    <div class="card">
        <div class="card-header bg-inv-primary text-inv-secondary border-0">
            <h5>Clients List</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover ">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Basic Details</th>
                        <th>Address</th>
                        <th>Business Details</th>
                        <th class="text-center">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td scope="row">{{ $client->id }}</td>
                            <td>
                                <h6> {{ $client->name }}</p>
                                    <small> {{ $client->email }}</small><br>
                                    <small> {{ $client->number??'N/A' }}</small>

                            </td>
                            <td>{{ $client->address??'N/A' }}</td>
                            <td>
                                <small><strong>TAX ID:</strong>{{ $client->tax_id }}</small><br>
                                <small><strong>Reg NO :</strong>{{ $client->registration_number??'N/A' }}</small>
                            </td>
                             <td>
                                <small><strong>Bank:</strong>{{ $client->bank->name }}</small><br>
                                <small><strong>A/c NO:</strong>{{ $client->account_number }}</small>
                            </td>
                            <td class="text-center">
                                <a wire:navigate href="{{ route('admin.clients.edit', $client->id) }}"
                                    class="btn btn btn-secondary">
                                    <i class="bi bi-pencil-square"></i>

                                </a>
                                <a  class="btn btn btn-secondary">
                                    <i class="bi bi-trash-fill"></i>

                                </a>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>