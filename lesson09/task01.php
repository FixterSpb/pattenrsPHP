<?php

require "./library.php";
/**
 * 1. Создать массив на миллион элементов и отсортировать его различными способами. Сравнить скорости.
 */
$arrayLength = 10000;
$array = getArray($arrayLength);

$start = microtime(true);
bubbleSort($array);
$time= microtime(true) - $start;
echo "Пузырьковая сортировка. Количество элементов: $arrayLength. Время сортировки: $time с.\n";

$start = microtime(true);
shakerSort($array);
$time= microtime(true) - $start;
echo "Шейкерная сортировка. Количество элементов: $arrayLength. Время сортировки: $time с.\n";

$start = microtime(true);
quickSort($array);
$time= microtime(true) - $start;
echo "Быстрая сортировка. Количество элементов: $arrayLength. Время сортировки: $time с.\n";

$start = microtime(true);
heapSort($array);
$time= microtime(true) - $start;
echo "Пирамидальная сортировка. Количество элементов: $arrayLength. Время сортировки: $time с.\n";