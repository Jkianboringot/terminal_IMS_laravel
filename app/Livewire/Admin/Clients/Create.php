<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Bank;
use App\Models\Client;
use Livewire\Component;

class Create extends Component
{
     public Client $client;

    function rules(){
            return [
                'client.name'=>'required',
                'client.email'=>'required|unique:clients,email',
                'client.address'=>'nullable',
                'client.phone_number'=>'nullable',
                'client.registration_number'=>'nullable',
                'client.tax_id'=>'required',
                'client.bank_id'=>'required',
                'client.account_number'=>'required',
               


            ];
    }
    function mount(){
            $this->client = new Client();
    }

    function updated(){
 $this->validate() ; 
    }

    function save(){
  $this->validate();
        try {
     
             $this->client->save(); 
                
             return redirect()->route('admin.clients.index');
            } catch (\Throwable $th) {
                $this->dispatch('done',error:'Something went wrong: '.$th->getMessage());
            }
    }
    public function render()
    {
        return view('livewire.admin.clients.create',[
    'banks'=>Bank::all()]
);
    }
}
