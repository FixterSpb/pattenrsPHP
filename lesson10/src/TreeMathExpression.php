<?php

require_once "NodeCalculate.php";
require_once "NodeExpression.php";

class TreeMathExpression implements NodeCalculate, JsonSerializable
{
    private NodeExpression $root;
    private string $expression;

    public function __construct(string $expression)
    {
        $expression = str_replace(" ", "", $expression);
        preg_match_all("/\d+\.*\d*|[\+-\/*\(\)\^]/", $expression, $tokens);
//        print_r($tokens);
//        die;
        $this->root = new NodeExpression($tokens[0]);
    }

    public function calc(): float
    {
        return $this->root->calc();
    }

    public function getExpression(){
        return $this->expression;
    }

    public function jsonSerialize(): array
    {
        return [
            "expression" => $this->root,
            "result" => $this->calc(),
        ];
    }
}