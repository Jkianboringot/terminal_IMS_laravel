<?php

namespace App\Livewire\Admin\Clients;


use App\Models\Client;
use Livewire\Component;

class Create extends Component
{
     public Client $client;

    function rules(){
            return [
                'client.name'=>'required',
                'client.email'=>'required|unique:clients,email',
                'client.address'=>'nullable|string|max:85',
                'client.phone_number'=>'nullable|string|max:20',
                'client.tax_id'=>'required',
                'client.account_number'=>'required',
                'client.organization_type'=>'nullable|string', // i will allow this to be null incase customer is not affiated with an org
                    

               


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
        $organization_types=['Government','Private','NGO','COOPERATIVE'];
        
        return view('livewire.admin.clients.create',[
            'organization_types'=>$organization_types
        ]);
    }
}
