<?php
namespace App\Http\Traits;

trait HasStock
{
    public function stockCount()
    {
        return $this->stock->sum('pivot.current_stock');
    }

    public function inStock()
    {
        return $this->stockCount() > 0;
    }
}
