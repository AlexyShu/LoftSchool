<?php

// На школьной выставке 80 рисунков. 23 из них выполнены фломастерами, 40 карандашами, а остальные — красками. Сколько рисунков, выполненные красками, на школьной выставке?
// Описать и вывести условия, решение этой задачи на PHP. Все предоставленные числа из пункта 1 должны быть указаны в константах.

const ALL_PICTURE = 80;
const PICTURES_BY_FELTTIP = 23;
const PICTURES_BY_PENCIL = 40;
$picturesByPaints = ALL_PICTURE - (PICTURES_BY_FELTTIP + PICTURES_BY_PENCIL);

echo "Рисунков выполненных красками, на школьной выставке $picturesByPaints" . PHP_EOL;
