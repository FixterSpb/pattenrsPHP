<?php
/**
 * 4. * Простые делители числа 13195 — 5, 7, 13 и 29.
 * Каков самый большой делитель числа 600851475143, являющийся простым числом?
 *
 * Оптимальнее не придумал...
 */
$count = 0;

function isPrime(int $n): bool {
    global $count;
    for ($i = floor(sqrt($n)); $i > 1; $i--){
        $count++;
        if ($n % $i === 0) return false;
    }
    return true;
}

$n = 600851475143;

function getMaxPrimeDivisor($n)
{
    global $count;
    for ($i = floor(sqrt($n)); $i > 1; $i--) {
        $count++;
        if ($n % $i === 0 && isPrime($i)) {
            return $i;
        }
    }

    return 1;
}

$start = microtime(true);
$result = getMaxPrimeDivisor($n);
$time = microtime(true) - $start;
echo "Результат: $result Время выполнения: $time Число итераций: $count";
