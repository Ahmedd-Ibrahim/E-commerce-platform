<?php
namespace App\Scoping\Scopes;

use App\Scoping\Contracts\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;

class CategoryScope implements ScopeInterface
{
    public function apply(Builder $builder, $value)
    {
        return $builder->whereHas('categories', function ($query) use ($value) {
            $query->where('slug', $value);
        });
    }
}
