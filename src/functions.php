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

//task 3
// Функция должна принимать два параметра – целые числа.
// Если в функцию передали 2 целых числа, то функция должна отобразить таблицу умножения размером со значения параметров, переданных в функцию. (Например если передано 8 и 8, то нарисовать от 1х1 до 8х8). Таблица должна быть выполнена с использованием тега <table>
// В остальных случаях выдавать корректную ошибку. 

function task3(int $number1, int $number2) {
    if(!is_int($number1) && !is_int($number2)) {
        return "Это не целое число!";
    }
    $result = "<table>" . PHP_EOL;
    for($i = 1; $i < $number1; $i++) {
        $result .= "<tr>" . PHP_EOL;
        for($j = 1; $j < $number2; $j++) {
            $result .= "<td>";
            $result .= $i * $j;
            $result .= "</td>";
        
        }
        $result .= "</tr>" . PHP_EOL;
    }
    $result .= "</table>" . PHP_EOL;
    echo $result;
}

//task 4
// Выведите информацию о текущей дате в формате 31.12.2016 23:59
// Выведите unixtime время соответствующее 24.02.2016 00:00:00.

function task4() {
    date_default_timezone_set("europe/moscow");
    echo "Сейчас: " . date("d.m.Y H:i") . PHP_EOL;
    echo "Unixtime время соответствующее 24.02.2016 00:00:00 = " . strtotime("24.02.2016 00:00:00") . PHP_EOL;;
}

//task 5
// Дана строка: “Карл у Клары украл Кораллы”. Удалить из этой строки все заглавные буквы “К”.
// Дана строка: “Две бутылки лимонада”. Заменить “Две”, на “Три”.

function task5() {
    $string1 = "Карл у Клары украл Кораллы." . PHP_EOL;;
    echo str_replace("К", "", $string1);
    $string2 = "Две бутылки лимонада." . PHP_EOL;;
    echo str_replace("Две", "Три", $string2);
}