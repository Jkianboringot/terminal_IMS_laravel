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



// TOBE FIX
// problem with Notification on why its not checking inventory balance is maybe becuase 
// inventory balance is not part of product is jst a proerty of it so i need to get in 
// thier somehow and access it but tis function go directly to teh data base to check fo low balnace
// which is not bad its just that it wounldnt work for inventory balance unless i make it 
// an column which its not so either make it a column or accesss it 








$existingIds = Notification::whereIn('product_id', $lowIds)
    ->pluck('product_id')
    ->all();

foreach ($low as $p) {
    if (! in_array($p->id, $existingIds)) {
        Notification::create([
            'product_id' => $p->id,
           'message' => "Low stock: {$p->name} (Qty:{$p->inventory_balance})"
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
