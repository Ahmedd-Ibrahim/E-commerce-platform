<?php
namespace App\Models;

use App\Http\Traits\CanBeScoped;
use App\Http\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, CanBeScoped, HasPrice;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function stock()
    {
        return $this->belongsToMany(Variation::class, 'product_variation_stock_view')
        ->withPivot([
            'current_stock',
            'available'
        ]);
    }

    public function stockCount()
    {
        return $this->stock->sum('pivot.current_stock');
    }
}
