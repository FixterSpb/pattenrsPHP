<?php

require "./NodeCalculate.php";
require "./NodeNumber.php";


class NodeExpression implements NodeCalculate, JsonSerializable
{
    public const ACTIONS = [
        "+" => "addition",
        "-" => "subtraction",
        "/" => "division",
        "*" => "multiplication",
        "^" => "exponentiation",
    ];

    private string $expression;
    private ?NodeCalculate $left = null;
    private ?NodeCalculate $right = null;
    private string $action = '';

    public function __construct(array $tokens)
    {
        $expression = implode(' ', $tokens);
        $countOpenBrackets = substr_count($expression, "(");
        $countCloseBrackets = substr_count($expression, ")");
        if ($countOpenBrackets !== $countCloseBrackets) {
            if ($countOpenBrackets > $countCloseBrackets) {
                array_splice($tokens, 0, 1);
            } else {
                array_splice($tokens, -1, 1);
            }
        }
        $this->expression = implode(' ', $tokens);

        $this->init($tokens);


    }

    private function init(array $tokens)
    {
        $posAction = $this->getPosActionInTokens($tokens);
        $this->action = $tokens[$posAction];
        $leftTokens = array_slice($tokens, 0, $posAction);
        $rightTokens = array_slice($tokens, $posAction + 1);
//        print_r($leftTokens);
//        print_r($rightTokens);
        if (!preg_grep("/[\+-\/*\^]/", $leftTokens)) {
            $value = implode(preg_grep("/\d+\.?\d*/", $leftTokens));
            $this->left = new NodeNumber($value);
        } else {

            $this->left = new NodeExpression($leftTokens);
        }


        if (!preg_grep("/[\+-\/*\^]/", $rightTokens)) {
            $value = implode(preg_grep("/\d+\.?\d*/", $rightTokens));
            $this->right = new NodeNumber($value);
        } else {
            $this->right = new NodeExpression($rightTokens);
        }
    }

    private function getPosActionInTokens(array $tokens): int
    {
        $countBrackets = 0;
        $maxPriority = 0;
        $actionIndex = 0;
        $priorities = [
            "+" => 3,
            "-" => 3,
            "*" => 2,
            "/" => 2,
            "^" => 1
        ];

        foreach ($tokens as $key => $value) {
            if (preg_match("/\d+\.*\d*/", $value)) {
                continue;
            }

            if ($value === '(') {
                $countBrackets++;
                continue;
            }

            if ($value === ')') {
                $countBrackets--;
                continue;
            }

            $priority = $priorities[$value] - 3 * $countBrackets;
            if ($priority >= $maxPriority) {
                $maxPriority = $priority;
                $actionIndex = $key;
            }

        }

        return $actionIndex;
    }

    public function calc(): float
    {
        $action = self::ACTIONS[$this->action];
        return self::$action($this->left->calc(), $this->right->calc());
    }

    private static function addition(float $a, float $b): float
    {
        return $a + $b;
    }

    private static function subtraction(float $a, float $b): float
    {
        return $a - $b;
    }

    private static function multiplication(float $a, float $b): float
    {
        return $a * $b;
    }

    private static function division(float $a, float $b): float
    {
        return $a / $b;
    }

    private static function exponentiation(float $a, float $b): float
    {
        return $a ** $b;
    }

    public function jsonSerialize(): array
    {
        return [
            "type" => "expression",
            "left" => $this->left,
            "right" => $this->right,
            "action" => $this->action,
            "expression" => $this->expression,
            "result" => $this->calc(),
        ];
    }
}