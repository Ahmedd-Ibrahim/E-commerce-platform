<?php
namespace App\Models;

use App\Cart\Money;
use App\Http\Traits\HasPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory, HasPrice;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function type()
    {
        return $this->hasOne(VariationType::class, 'id', 'variation_type_id');
    }

    public function getPriceAttribute($value)
    {
        if ($value == 0 || $value == null) {
            return $this->product->price;
        }

        return new Money($value);
    }
}
