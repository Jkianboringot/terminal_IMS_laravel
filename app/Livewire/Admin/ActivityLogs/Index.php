<?php

namespace App\Livewire\Admin\ActivityLogs;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ActivityLog;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $logs = ActivityLog::with('user')
            ->where(function ($query) {
                $query->where('action', 'like', '%' . $this->search . '%')
                      ->orWhere('model', 'like', '%' . $this->search . '%')
                      ->orWhere('user_id', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.activity-logs.index', [
            'logs' => $logs
        ]);
    }
}
