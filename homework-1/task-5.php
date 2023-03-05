<?php
$bmw = [
    "model" => "X5",
    "speed" => 200,
    "doors" => 5,
    "year" => "2015",
];

$toyota = [
    "model" => "Camry",
    "speed" => 180,
    "doors" => 5,
    "year" => "2017",
];

$opel = [
    "model" => "Corsa",
    "speed" => 120,
    "doors" => 5,
    "year" => "2023",
];

$cars = [
    "bmw" => $bmw, 
    "toyota" => $toyota, 
    "opel" => $opel,
];

foreach($cars as $name => $car) {
    echo "CAR $name" . PHP_EOL;
    $keys = array_keys($car);
    // echo "$car[model] $car[speed] $car[doors] $car[year]" . PHP_EOL;

    foreach($keys as $key) {
        echo "$car[$key]" .  " ";
    } 
    echo PHP_EOL;
};
