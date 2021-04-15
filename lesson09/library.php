<?php

function printArray($array)
{
    echo implode(", ", $array) . PHP_EOL;
}

function getArray(int $size, int $maxValue = null)
{
    $array = [];
    for ($i = 0; $i < $size; $i++) {
        $array[] = rand(0, $maxValue ?? $size);
    }
    return $array;
}

/**
 * Пузырьковая сортировка
 * @param int[] $array
 * @return int[]
 */
function bubbleSort(array $array)
{
    $count = count($array);
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count - $i - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                list($array[$j], $array[$j + 1]) = array($array[$j + 1], $array[$j]);
            }
        }
    }
    return $array;
}

/**
 * Шейкерная сортировка
 * @param array $array
 * @return array
 */
function shakerSort(array $array)
{
    $left = 0;
    $right = count($array) - 1;
    do {
        for ($i = $left; $i < $right; $i++) {
            if ($array[$i] > $array[$i + 1]) {
                list($array[$i], $array[$i + 1]) = array($array[$i + 1], $array[$i]);
            }
        }
        $right--;
        for ($i = $right; $i > $left; $i--) {
            if ($array[$i] < $array[$i - 1]) {
                list($array[$i], $array[$i - 1]) = array($array[$i - 1], $array[$i]);
            }
        }
        $left++;
    } while ($left < $right);

    return $array;
}

/**
 * Быстрая сортировка
 * @param array $array
 * @param int $low
 * @param int|null $high
 * @return array
 */
function quickSort(array $array, int $low = 0, int $high = null)
{
    $i = $low;
    $j = $high ?? count($array) - 1;
    $middle = $array[($low + $high) / 2];   // middle – опорный элемент; в нашей реализации он находится посередине между low и high
    do {
        while ($array[$i] < $middle) {// Ищем элементы для правой части
            $i++;
        }
        while ($array[$j] > $middle) {// Ищем элементы для левой части
            $j--;
        }
        if ($i <= $j) {
            list($array[$i], $array[$j]) = array($array[$j], $array[$i]);
            $i++;
            $j--;
        }
    } while ($i < $j);

    if ($low < $j) {
        // Рекурсивно вызываем сортировку для левой части
        quickSort($array, $low, $j);
    }

    if ($i < $high) {
        // Рекурсивно вызываем сортировку для правой части
        quickSort($array, $i, $high);
    }

    return $array;
}

/**
 * Сортировка кучи
 * @param array $array
 * @param int $countArr
 * @param int $i
 */
function heapify(array &$array, int $countArr, int $i)
{
    $largest = $i; // Инициализируем наибольший элемент как корень
    $left = 2 * $i + 1; // левый = 2*i + 1
    $right = 2 * $i + 2; // правый = 2*i + 2
// Если левый дочерний элемент больше корня
    if ($left < $countArr && $array[$left] > $array[$largest])
        $largest = $left;

//Если правый дочерний элемент больше, чем самый большой элемент на данный момент
    if ($right < $countArr && $array[$right] > $array[$largest])
        $largest = $right;

// Если самый большой элемент не корень
    if ($largest != $i) {
        $swap = $array[$i];
        $array[$i] = $array[$largest];
        $array[$largest] = $swap;

        // Рекурсивно преобразуем в двоичную кучу затронутое поддерево
        heapify($array, $countArr, $largest);
    }
}

/**
 * Пирамидальная сортировка
 * @param array $array
 * @return mixed
 */
function heapSort(array $array)
{
    $countArr = count($array);
// Построение кучи (перегруппируем массив)
    for ($i = $countArr / 2 - 1; $i >= 0; $i--)
        heapify($array, $countArr, $i);

//Один за другим извлекаем элементы из кучи
    for ($i = $countArr - 1; $i >= 0; $i--) {
        // Перемещаем текущий корень в конец
        $temp = $array[0];
        $array[0] = $array[$i];
        $array[$i] = $temp;

        // вызываем процедуру heapify на уменьшенной куче
        heapify($array, $i, 0);
    }
    return $array;
}

/**
 * Линейный поиск
 * @param array $array
 * @param int $value
 * @param int $countLoops
 * @return int|null
 */
function lineSearch(array $array, int $value, int &$countLoops = null)
{
    $countLoops = 0;
    for ($i = 0; $i < count($array); $i++) {
        $countLoops++;
        if ($array[$i] === $value) return $i;
    }
    return null;
}

/**
 * Бинарный поиск
 * @param array $array
 * @param int $num
 * @param int|null $countLoops
 * @return int|null
 */
function binarySearch(array $array, int $num, int &$countLoops = null)
{

    $countLoops = 0;
    $left = 0;
    $right = count($array) - 1;

    while ($left <= $right) {
        $middle = floor(($right + $left) / 2);

        if ($array[$middle] === $num) {
            return $middle;
        } elseif ($array[$middle] > $num) {
            $right = $middle - 1;
        } else {
            $left = $middle + 1;
        }
        $countLoops++;
    }
    return null;
}

/**
 * Интерполяционный поиск
 * @param array $array
 * @param int $value
 * @param int $countLoops
 * @return int|null
 */
function interpolationSearch(array $array, int $value, int &$countLoops = null)
{
    $countLoops = 0;
    $first = 0;
    $last = count($array) - 1;

    while ($last > $first && $array[$first] <= $value && $array[$last] >= $value) {

        $pos = (int)floor($first + ($last - $first) / ($array[$last] - $array[$first]) * ($value - $array[$first]));

        if ($array[$pos] === $value) {
                return $pos;
        }

        if ($value > $array[$pos]) {
            $first = $pos + 1;
        } else {
            $last = $pos - 1;
        }

        $countLoops++;
    }

    return null;

}

/**
 * Удаление элементов массива, равных $value
 * @param array $array
 * @param int $value
 * @return array
 */
function deleteFormArray(array $array, int $value)
{
    $idx = interpolationSearch($array, $value);
    if (is_null($idx)) return $array;

    while ($idx < count($array) && $array[$idx] === $value) {
        array_splice($array, $idx, 1);
    }

    while (--$idx >= 0 && $array[$idx] === $value){
        array_splice($array, $idx, 1);
    }

    return $array;
}

/**
 * Определяет, является ли число простым
 * @param int $number
 * @param int $countLoops
 * @return bool
 */
function isPrime(int $number, int &$countLoops): bool {
    for ($i = 2; $i <= sqrt($number); $i++){
        if ($number % $i === 0) return false;
        $countLoops++;
    }

    return true;
}