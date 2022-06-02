<?php
namespace App\Models;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Address()
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
