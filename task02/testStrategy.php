<?php

include_once "./PayCollection.php";
include_once "./QiwiPayService.php";
include_once "./YandexPayService.php";
include_once "./WebmoneyPayService.php";

    echo (new PayCollection())->pay(new QiwiPayService(), 9999, 79999999999)['status'] . PHP_EOL;
    echo (new PayCollection())->pay(new YandexPayService(), 7999, 79777777777)['status'] . PHP_EOL;
    echo (new PayCollection())->pay(new WebmoneyPayService(), 5999, 79555555555)['status'] . PHP_EOL;
