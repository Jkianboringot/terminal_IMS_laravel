<?php

namespace App\Livewire\Admin\Customers;


use App\Models\Customer;
use Livewire\Component;

class Create extends Component
{
     public Customer $customer;

    function rules(){
            return [
                'customer.name'=>'required',
                'customer.email'=>'required|unique:customers,email',
                'customer.address'=>'nullable|string|max:85',
                'customer.phone_number'=>'nullable|string|max:20',
                'customer.tax_id'=>'required|unique:customers,tax_id',
                'customer.organization_type'=>'nullable|string', // i will allow this to be null incase customer is not affiated with an org
                // 'customer.account_number'=>'nullable', 
                // this is the problem on why its not creating customer
                    // its pretty much interfering because not only those it not exist but also its required so it 
                    // will not proceed to make anythig but if uncomment it and amke it nullable it will let me creaate
                    // but most like it will give me an error taht acc number is not a column in my db
                    // the problem was how livewire handle requied rules 
                    

               


            ];
    }
    function mount(){
            $this->customer = new Customer();
    }

    function updated(){
 $this->validate() ; 
    }

    function save(){
  $this->validate();
        try {
     
             $this->customer->save(); 
                
             return redirect()->route('admin.customers.index');
            } catch (\Throwable $th) {
                $this->dispatch('done',error:'Something went wrong: '.$th->getMessage());
            }
    }
    public function render()
    {
        $organization_types=['Government','Private','NGO','COOPERATIVE'];
        
        return view('livewire.admin.customers.create',[
            'organization_types'=>$organization_types
        ]);
    }
}
