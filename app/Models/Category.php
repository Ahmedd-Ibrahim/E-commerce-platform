<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    public function scopeParents(Builder $bulder)
    {
        return $bulder->whereNull('parent_id');
    }

    public function scopeChildrens(Builder $bulder)
    {
        return $bulder->whereNotNull('parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'catgeory_product');
    }
}
