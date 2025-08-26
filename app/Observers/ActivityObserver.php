<?php
namespace App\Observers;

use App\Models\ActivityLog;

class ActivityObserver
{
    public function created($model)
    {
        $this->logActivity('created', $model);
    }

    public function updated($model)
    {
        $this->logActivity('updated', $model, [
            'old' => $model->getOriginal(),
            'new' => $model->getAttributes()
        ]);
    }

    public function deleted($model)
    {
        $this->logActivity('deleted', $model);
    }

    protected function logActivity($action, $model, $changes = null)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model' => class_basename($model),
            'model_id' => $model->id,
            'changes' => $changes ? json_encode($changes) : null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }
}
