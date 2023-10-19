<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderBillingAddress extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'postcode', 'city', 'street'];

    public $timestamps = false;
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
