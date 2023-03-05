<?php
const ALL_PICTURE = 80;
const PICTURES_BY_FELTTIP = 23;
const PICTURES_BY_PENCIL = 40;
$picturesByPaints = ALL_PICTURE - (PICTURES_BY_FELTTIP + PICTURES_BY_PENCIL);

echo "Рисунков выполненных красками, на школьной выставке $picturesByPaints" . PHP_EOL;
