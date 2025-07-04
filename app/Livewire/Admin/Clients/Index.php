<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
      function delete($id)
    {
        try {
            $client = Client::findOrFail($id);
            if (count($client->sales) >0 ) {
                throw new \Exception("Permission : This Client has Bought from you {$client->sales->count()} Client ", 1);
            }

       
            $client->delete();

            $this->dispatch('done', success: "Successfully Deleted this user");
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatch('done', error: "Something went wrong: " . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.clients.index',[
            'clients'=>Client::orderBy('id','DESC')->paginate(10)
        ]);
    }
}
