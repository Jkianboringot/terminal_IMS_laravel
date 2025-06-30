<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class Dashboard extends Component
{
    
    public $options =[
    'last_7_days',
    'last_28_days',
    'last_90_days',
    'last_365_days',
    'lifetime',

    ];


public $selectedOption='last_28_days';

public $dateRange=[];

public  function getDates(){
    switch ($this->selectedOption) {
        case 'last_7_days':
            $dates=CarbonPeriod::create(Carbon::now()->subDay(7),'1 days',Carbon::now());
            break;
            case 'last_28_days':
            $dates=CarbonPeriod::create(Carbon::now()->subDay(28),'4 days',Carbon::now());
            break;
            case 'last_90_days':
            $dates=CarbonPeriod::create(Carbon::now()->subDay(90),'12 days',Carbon::now());
            break;
            case 'last_365_days':
            $dates=CarbonPeriod::create(Carbon::now()->subDay(365),'52 days',Carbon::now());
            break;
           
            
        
        default:
           $date1=DB::table('sales')->union(DB::table('purchases'))->min('create_at');
           $date2=Carbon::now();
           $dateVariance=Carbon::parse($date1)->diffInDays($date2)/7;
           $dates=CarbonPeriod::create($date1,$dateVariance,$date2); 
            break;
    }
    return $dates;
}



 public function updatedSelectedOption(){

    $this->dispatch('chart-updated',
      $this->dateRange
    );
 }
function getPurchases(){

    
} 

function getSales(){

    
} 
    public function render()
    {
        $this->dateRange=$this->getDates()->toArray();
        // $this->dispatch('chart-updated',[
        //     'dataRange'=>$this->dateRange
        // ]);
        return view('livewire.admin.dashboard');
    }
}
