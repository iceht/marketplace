<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'quantity', 'unit_price'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
