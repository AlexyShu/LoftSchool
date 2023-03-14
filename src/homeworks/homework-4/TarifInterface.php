<?php

interface TarifInterface {
    public function countPrice(): int;
    public function addService(ServiceInterface $service);
    public function getMinuts(): int;
    public function getDistance(): int;
}