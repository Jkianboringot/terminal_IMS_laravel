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
        $lowStockProducts = Product::where('quantity', '<', 10)->get();

        foreach ($lowStockProducts as $product) {
            // Avoid duplicate notifications for the same product
            $exists = Notification::where('message', 'LIKE', "%{$product->name}%")->exists();

            if (! $exists) {
                Notification::create([
                    'message' => "Low stock alert: {$product->name} (Qty: {$product->quantity})"
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
