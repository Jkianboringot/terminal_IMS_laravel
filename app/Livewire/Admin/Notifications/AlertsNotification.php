<?php

namespace App\Livewire\Admin\Notifications;

use App\Models\Product;
use App\Models\Notification;
use Livewire\Component;

class AlertsNotification extends Component
{
    public $notifications;

    public function mount()
    {
        $this->checkLowStock();
        $this->loadNotifications();
    }
   

    
                 
    public function checkLowStock()
    {
       // assume notifications table has product_id column and unique index on product_id
$low = Product::where('quantity', '<', 10)->get();
$lowIds = $low->pluck('id')->all();

$existingIds = Notification::whereIn('product_id', $lowIds)
    ->pluck('product_id')
    ->all();

foreach ($low as $p) {
    if (! in_array($p->id, $existingIds)) {
        Notification::create([
            'product_id' => $p->id,
           'message' => "Low stock: {$p->name} (Qty:{$p->quantity})"
                    // dont think this i a goodidea to do this but it will do for now
        ]);
    }
}

    }

    public function loadNotifications()
    {
        $this->notifications = Notification::latest()->get();
    }

    public function deleteNotification($id)
    {
        Notification::findOrFail($id)->delete();
        $this->loadNotifications();
    }

    public function deleteAllNotifications()
    {
        Notification::truncate();
        $this->notifications = collect();
    }

    public function render()
    {
        return view('components.alerts-notification', [
            'notifications' => $this->notifications
        ]);
    }
}
