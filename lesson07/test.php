<?php

class A {
    public int $a = 0;
    public int $b = 0;

}

class Test {
    private static A $a;

    /**
     * @param A $a
     */
    public static function setA(A $a): void
    {
        self::$a = $a;
    }

    /**
     * @return A
     */
    public static function getA(): A
    {
        return self::$a;
    }
}

$a = new A();
$a->a = 1;
$a->b = 2;

$test = new Test();
$test->setA($a);
var_dump($test->getA());


$a->a = 10;
$a->b = 20;
var_dump($test->getA());
