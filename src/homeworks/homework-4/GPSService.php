<?php

class GPSService implements ServiceInterface {
    private $hourPrice;

    public function __construct(int $hourPrice)
    {
        $this->hourPrice = $hourPrice;
    }

    public function apply(TarifInterface $tarif, &$price)
    {
        $hours = ceil($tarif->getMinutes() / 60);
        $price += $this->hourPrice * $hours;
    }
}