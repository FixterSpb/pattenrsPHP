<?php

require './library.php';

$array = heapSort(getArray(1000, 100));
$value = rand(0, 100);
$countLoops = 0;

echo "Поиск числа $value.\n";
$idx = lineSearch($array, $value, $countLoops);

echo "Линейный поиск. Результат ", $idx ?? 'Элемент отсутствует ', " Количество шагов:  ", ++$countLoops, PHP_EOL;

$idx = binarySearch($array, $value, $countLoops);
echo "Бинарный поиск. Результат ", $idx ?? 'Элемент отсутствует ', " Количество шагов:  ", ++$countLoops, PHP_EOL;

$idx = interpolationSearch($array, $value, $countLoops);
echo "Интероляционный поиск. Результат ", $idx ?? 'Элемент отсутствует ', " Количество шагов: ", ++$countLoops, PHP_EOL;
