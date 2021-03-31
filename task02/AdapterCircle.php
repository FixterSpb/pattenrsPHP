<?php

include_once "ICircle.php";
include_once "./CircleAreaLib.php";

class AdapterCircle implements ICircle
{

    public function circleArea(float $circumference) //длина окружности
    {
        return (new CircleAreaLib())->getCircleArea($circumference / M_PI);
    }
}