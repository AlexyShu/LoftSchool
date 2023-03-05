<?php
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