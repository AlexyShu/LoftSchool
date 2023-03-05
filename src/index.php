<?php
require('functions.php');

echo task1(["test 1", "test 2", "test 3"], true);
echo task1(["test 1", "test 2", "test 3"], false);
echo PHP_EOL;

echo task2("+", 1, 2, 3) . PHP_EOL;
echo task2("-", 1, 2, 3) . PHP_EOL;
echo task2("*", 1, 2, 3) . PHP_EOL;
echo task2("/", 1, 2, 3) . PHP_EOL;

echo task3(5,7);

echo task4();

echo task5();

echo task6("text.txt");