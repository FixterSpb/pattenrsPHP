<?php

include_once "./ISquare.php";
include_once "./SquareAreaLib.php";

class AdapterSquare implements ISquare
{

    function squareArea(float $sideSquare) //Сторона квадрата
    {
        return (new SquareAreaLib())->getSquareArea($sideSquare * sqrt(2));
    }
}