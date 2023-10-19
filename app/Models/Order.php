<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\ShippingMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => OrderStatus::class,
        'shipping_method' => ShippingMethod::class,
    ];

    public function products(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function shippingAddress(): HasOne
    {
        return $this->hasOne(OrderShippingAddress::class);
    }

    public function billingAddress(): HasOne
    {
        return $this->hasOne(OrderBillingAddress::class);
    }

}
