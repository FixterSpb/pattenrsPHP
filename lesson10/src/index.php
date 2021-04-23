<?php

    require "./NodeExpression.php";
    require_once "./TreeMathExpression.php";

    $data = json_decode(file_get_contents("php://input"));
    $expression = $_GET['expression'] ?: '1+1';

//    preg_match_all("/\d+\.*\d*|[\+-\/*\(\)\^]/", '27/2*7*5*(20+7-3*16/2+37-12)/(3+(7+5))+15*7', $out);
    header("Access-Control-Allow-Origin: *");
//    echo json_encode(new NodeExpression($out[0]));
//    echo $expression;
//    die;
    echo json_encode(new TreeMathExpression($expression), JSON_FORCE_OBJECT);
//    var_dump($data, $_GET['expression']);
//    die;
//    echo json_encode($data, JSON_FORCE_OBJECT);
