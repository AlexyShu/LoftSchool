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

// task 2
// Функция должна принимать переменное число аргументов.
// Первым аргументом обязательно должна быть строка, обозначающая арифметическое действие, которое необходимо выполнить со всеми передаваемыми аргументами.
// Остальные аргументы это целые и/или вещественные числа.
// Пример вызова: calcEverything(‘+’, 1, 2, 3, 5.2);
// Результат: 1 + 2 + 3 + 5.2 = 11.2

function task2(string $action, ...$args) {
    switch($action) {
        case "+":
            return array_sum($args);
            break;
        case "-":
            return array_shift($args) - array_sum($args);
            break;
        case "*":
            $result = reset($args);
            for($i = 1; $i < count($args); $i++) {
                $result *= $args[$i];
            }
            return $result;
            break;
        case "/":
            $result = reset($args);
            for($i = 1; $i < count($args); $i++) {
                $result /= $args[$i];
            }
            return $result;
            break;
            
        default:
            return"Неизвестный симфол" ;
            break;
    };
}

