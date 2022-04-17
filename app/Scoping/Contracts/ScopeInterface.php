<?php
namespace App\Scoping\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface ScopeInterface
{
    public function apply(Builder $builder, $value);
}
