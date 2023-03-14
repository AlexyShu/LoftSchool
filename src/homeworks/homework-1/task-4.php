<?php

// Создайте переменную '$day' и присвойте ей произвольное числовое значение.
// С помощью конструкции switch выведите фразу “Это рабочий день”, если значение переменной $day попадает в диапазон чисел от 1 до 5 (включительно).
// Выведите фразу “Это выходной день”, если значение переменной $day равно числам 6 или 7.
// Выведите фразу “Неизвестный день”, если значение переменной '$day' не попадает в диапазон чисел от 1 до 7 (включительно)

$day = mt_rand(1, 7);
echo "Сегодня $day день недели" . PHP_EOL;

switch ($day) {
    case ($day >= 1 && $day <= 5):
        echo "Это рабочий день" . PHP_EOL;
        break;
    case ($day === 6 || $day === 7):
        echo "Это выходной день" . PHP_EOL;
        break;
    default:
        echo "Неизвестный день" . PHP_EOL;
        break;
};