<?php
namespace App\Models;

use App\Cart\Money;
use App\Http\Traits\HasPrice;
use App\Http\Traits\HasStock;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collections\ProductVarationCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variation extends Model
{
    use HasFactory, HasPrice, HasStock;

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

    public function minStock($count)
    {
        return min($this->stockCount(), $count);
    }

    public function stock()
    {
        return $this->belongsToMany(Product::class, 'product_variation_stock_view')
        ->withPivot([
            'current_stock',
            'available'
        ]);
    }

    public function newCollection(array $models = [])
    {
        return new ProductVarationCollection($models);
    }
}
