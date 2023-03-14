<?php

class GPSService implements ServiceInterface 
{
    private $hourPrice;

    public function __construct(int $hourPrice)
    {
        $this->hourPrice = $hourPrice;
    }

    public function apply(TariffInterface $tariff, &$price)
    {
        $hours = ceil($tariff->getMinutes() / 60);
        $price += $this->hourPrice * $hours;
    }
}