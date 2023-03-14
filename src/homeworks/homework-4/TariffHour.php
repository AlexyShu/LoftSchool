<?php

class TariffHour extends TariffAbstract 
{
    protected $minutPrice = 0;
    protected $kmPrice = 200 / 60;

    public function __construct(int $distance, int $minutes)
    {
        parent::__construct($distance, $minutes);
        $this->minutes = $this->minutes - ($this->minutes % 60) + 60;
        
    }
}