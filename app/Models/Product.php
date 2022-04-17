<?php
namespace App\Models;

use App\Scoping\Scoper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeWithScopes(Builder $builder, array $scopes = [])
    {
        return (new Scoper(request()))->apply($builder, $scopes);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }
}
