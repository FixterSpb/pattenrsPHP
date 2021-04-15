<?php

require './library.php';

$array = [2];
$i = 3;
$start = microtime(true);
$countLoops = 0;
do{
    if (isPrime($i, $countLoops)) $array[] = $i;
    $i += 2;
}while (count($array) < 10001);

printArray($array);
echo "10001-е простое число: ", $array[10000], PHP_EOL;
echo "Времы выполнения: ", microtime(true) - $start, " Количество шагов: $countLoops.", PHP_EOL;
