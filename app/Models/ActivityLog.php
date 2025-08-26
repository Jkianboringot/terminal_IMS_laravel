<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'model',
        'model_id',
        'changes',
        'ip_address',
        'user_agent'
    ];

    // If you want to automatically cast 'changes' JSON to array
    protected $casts = [
        'changes' => 'array',
    ];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
