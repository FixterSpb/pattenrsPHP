<?php

include_once "./IPayService.php";

class PayCollection
{
    public function pay(IPayService $payService, float $total, int $phone): array
    {
        return $payService->pay($total, $phone);
    }
}