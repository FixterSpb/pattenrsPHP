<?php

namespace Model\Repository;

require_once '../../../vendor/autoload.php';

use \Ds\Set;

$product = new Product();

$product->fetchAll();

//var_dump($product->identityMap->search([1, 3, 1]));

//var_dump($product->identityMap->getEntityById(3));

$arr = [1, 2, 3, 5];
$arr1 = [1 => 7, 2 => 8];

var_dump(array_filter($arr,
    fn($value) => !in_array($value, array_keys($arr1))
));
