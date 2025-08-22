<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
       public string $search = '';

       public function updatingSearch()
    {
        // Reset pagination when search input changes
        $this->resetPage();
    }
      function delete($id)
    {
        try {
            $client = Client::findOrFail($id);
            if (count($client->sales) >0 ) {
                throw new \Exception("Permission : This Client has Bought from you {$client->sales->count()} Client ", 1);
            }

       
            $client->delete();

            $this->dispatch('done', success: "Successfully Deleted this Client");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
      $search = trim($this->search);

$clients = Client::when($search, fn ($query) =>
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        })
    )
    ->orderBy('name')
    ->paginate(10);
    


        return view('livewire.admin.clients.index',[
            'clients'=>$clients]);
    }
}

// Change all client name to Customer
