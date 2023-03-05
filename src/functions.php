<?php

// task 1
// Функция должна принимать массив строк и выводить каждую строку в отдельном параграфе (тег <p>)
// Если в функцию передан второй параметр true, то возвращать (через return) результат в виде одной объединенной строки.

function task1(array $array, bool $value = false) {
    if(!$value) {
        $strings = implode(", ", $array);
    return "<p> $strings</p>" . PHP_EOL;
    } 

    $strings = implode(", ", array_map( function(string $string) {
        return "<p> $string</p>";
    }, $array));

    return $strings;
}


