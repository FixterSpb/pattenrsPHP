<?php

require './library.php';

/* 2. Реализовать удаление элемента массива по его значению. Обратите внимание на возможные дубликаты!
 *
 */
$array = getArray(30, 10);
$value = 0;//rand(0, 10);

$sortArray = heapSort($array);
printArray($sortArray);
echo "Удаляем элементы, равные $value\n";
printArray(deleteFormArray($sortArray, $value));


