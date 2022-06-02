<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function shippingMethods()
    {
        return $this->belongsToMany(ShippingMethod::class, 'country_shipping_method');
    }
}
