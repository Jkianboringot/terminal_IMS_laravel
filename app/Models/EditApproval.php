<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EditApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'add_product_id',
        'user_id',
        'changes',
        'status',
    ];

    protected $casts = [
        'changes' => 'array',
    ];

    public function addProduct()
    {
        return $this->belongsTo(AddProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
