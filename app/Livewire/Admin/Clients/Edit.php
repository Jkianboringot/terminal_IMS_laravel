<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;

class Edit extends Component
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
    function mount($id){
            $this->client = Client::find($id);
    }

    function updated(){
 $this->validate() ; 
    }

    function save(){
  $this->validate();
        try {
     
             $this->client->update(); 
                
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