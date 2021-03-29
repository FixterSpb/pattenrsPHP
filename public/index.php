<?php

use app\service\TestService;

require_once '../vendor/autoload.php';


$service = new TestService();

//var_dump($service->test());
$result = $service->getProduct(1);
print_r($result);

echo 'id = ', $result->getId() , '; name = ', $result->getName(), '; price = ', $result->getPrice(), PHP_EOL;