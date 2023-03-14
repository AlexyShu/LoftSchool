<?php

//task 1
function task1()
{
    $names = ['Sasha', 'Masha', 'Petr', 'Ivan', 'Olya'];
    return [
        'name' => $names[array_rand($names)],
        'age' => mt_rand(18, 45),
    ];
}
