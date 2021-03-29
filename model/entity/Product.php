<?php

namespace app\model\entity;

class Product extends Entity
{
    private int $id;
    private string $name;
    private float $price;

    public function __construct(int $id = 0, string $name = '', float $price = 0){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getPrice(): float{
        return $this->price;
    }
}