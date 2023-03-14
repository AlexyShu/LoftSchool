<?php

interface TariffInterface 
{
    public function countPrice(): int;
    public function addService(ServiceInterface $service);
    public function getMinutes(): int;
    public function getDistance(): int;
}