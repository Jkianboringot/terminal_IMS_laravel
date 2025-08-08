<?php

namespace App\Livewire\Admin\Notifications;

use App\Models\Notification;
use Livewire\Component;

class AlertsNotification extends Component
{



    public $notifications;

  



    public function mount()
    {
        $this->loadNotifications();
    
    }

    public function loadNotifications()
    {
        $this->notifications = Notification::latest()->get();
    }

    function deleteNotification($id)
    {
        $noti = Notification::findOrFail($id);
    
        $noti->delete();
        $this->loadNotifications();
    }

    function deleteAllNotifications()
    {
        Notification::truncate();
       

        $this->notifications = collect();
    }
    public function addNotification($msg)
    {
        Notification::create(['message' => $msg]);
       


        $this->loadNotifications();
    }

    public function render()
    {


        return view('components.alerts-notification', [
            'notifications' => $this->notifications,

        ]);
    }
}


// i will do this own my own without gpt jsut google and w3school its fine if it takes 10 days