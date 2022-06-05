<?php
namespace App\Models;

use App\Cart\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PENDING = 'pending';
    const PROCESSING = 'processing';
    const PAYMENT_FAILED = 'payment_failed';
    const COMPLETED = 'completed';

    protected $fillable = ['shipping_method_id', 'address_id', 'subtotal'];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($order) {
            $order->status = self::PENDING;
        });
    }

    public function getSubTotalAttribute($value)
    {
        return new Money($value);
    }

    public function getTotalAttribute()
    {
        return $this->subtotal->add($this->shippingMethod->price);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    public function products()
    {
        return $this->belongsToMany(Variation::class, 'varition_order')
        ->withPivot(['quantity'])
        ->withTimestamps();
    }
}
