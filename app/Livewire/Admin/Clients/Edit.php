<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Illuminate\Validation\Rules\Unique;
use Livewire\Component;

class Edit extends Component
{
     public Client $client;

    function rules(){
            return [
                 'client.name'=>'required',
                'client.email'=>'required',
                'client.address'=>'nullable|string|max:85',
                'client.phone_number'=>'nullable|string|max:20',
                'client.tax_id'=>'required',
                'client.account_number'=>'required',
                'client.organization_type'=>'nullable|string', // i will allow this to be null incase customer is not affiated with an org
                    



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
        $organization_types=['Government','Private','NGO','COOPERATIVE'];
        
        return view('livewire.admin.clients.create',[
            'organization_types'=>$organization_types
        ]);
    }
}