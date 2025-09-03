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
    
   $products = Product::select('id', 'name', 'inventory_threshold')->get();


    $lowProducts = $products->filter(function ($product) {
        return $product->inventory_balance <= ($product->inventory_threshold ?? 10);
    });

    $okProducts = $products->filter(function ($product) {
        return $product->inventory_balance > ($product->inventory_threshold ?? 10);
    });

    $lowIds = $lowProducts->pluck('id');//->all();

    $existingIds = Notification::whereIn('product_id', $lowIds)
        ->pluck('product_id')->toArray();
        //->all();
    // just  uncomment the all if shit goes wrong
    foreach ($lowProducts as $p) {
        if (! in_array($p->id, $existingIds)) {
            Notification::create([
                'product_id' => $p->id,
                'message'    => "Low stock: {$p->name} (Qty: {$p->inventory_balance})"
            ]);
        }
    }

    // 🧹 Remove notifications for products that are back in stock
    Notification::whereIn('product_id', $okProducts->pluck('id'))->delete();
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
