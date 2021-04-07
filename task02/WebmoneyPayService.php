<?php

include_once "./IPayService.php";

class WebmoneyPayService implements IPayService
{

    public function pay(float $total, int $phone): array
    {
        echo "Оплата при помощи сервиса WebMoney" . PHP_EOL;
        //Получение ответа от сервиса, преобразование к одному формату
        return ['status' => 'ok'];
    }
}