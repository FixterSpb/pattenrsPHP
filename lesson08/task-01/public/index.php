<?php


$path = $_GET['path'] ?? './';
//$path = mb_substr($path, 1) . '/';
//echo $path;
//die;
$directory = new DirectoryIterator($path);
$files = [];

require "../views/index.php";
