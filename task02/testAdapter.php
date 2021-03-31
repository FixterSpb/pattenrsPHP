<?php

include_once "./AdapterSquare.php";
include_once "./AdapterCircle.php";
include_once "./SquareAreaLib.php";

//Квадрат
$sideSquare = 4;
$circumference = 10;
echo "Кватрат со стороной $sideSquare имеет площадь " . (new AdapterSquare())->squareArea($sideSquare) . PHP_EOL;

echo "Окружность длиной $circumference имеет площадь " . (new AdapterCircle())->circleArea($circumference) . PHP_EOL;