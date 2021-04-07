<?php

interface IPayService
{
    public function pay(float $total, int $phone): array;
}