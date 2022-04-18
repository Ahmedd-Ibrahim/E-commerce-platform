<?php
namespace App\Http\Traits;

use App\Cart\Money;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

trait HasPrice
{
    public function getPriceAttribute($value)
    {
        return new Money($value);
    }

    public function getFormatedPriceAttribute()
    {
       return $this->price->formated();
    }
}
