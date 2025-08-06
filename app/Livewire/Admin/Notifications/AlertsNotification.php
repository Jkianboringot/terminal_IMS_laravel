<?php

namespace App\Livewire\Admin\Notifications;

use App\Models\Notifications;
use Livewire\Component;

class AlertsNotification extends Component
{

   public $noti;

public function render()
{
         $this->noti='hi from noti';
    
    return view('components.alerts-notification', [
        'notes' => $this->noti,
       
    ]);
}


}


// i will do this own my own without gpt jsut google and w3school its fine if it takes 10 days