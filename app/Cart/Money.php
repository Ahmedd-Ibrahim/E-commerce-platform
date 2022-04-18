<?php
namespace App\Cart;

use Money\Currency;
use Money\Money as BaseMoney;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

class Money
{
    protected $money;

    public function __construct($value)
    {
        $this->money = new BaseMoney($value, new Currency('SAR'));
    }

    public function formated()
    {
        $formater = new IntlMoneyFormatter(new \NumberFormatter('EN_SAR', \NumberFormatter::CURRENCY), new ISOCurrencies);

        return $formater->format($this->money);
    }
}
