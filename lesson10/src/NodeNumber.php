<?php

require_once "./NodeCalculate.php";


class NodeNumber implements NodeCalculate, JsonSerializable
{
    private float $value;

    public function __construct(float $value)
    {
//        echo $value . PHP_EOL;
        $this->value = $value;
    }

    public function calc(): float
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return [
            "type" => "number",
            "value" => $this->value
        ];
    }
}