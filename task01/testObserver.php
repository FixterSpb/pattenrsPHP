<?php

include_once "./Applicant.php";
include_once "./HhSubject.php";

$hh = new HhSubject();
$john = new Applicant('John', 'j@mail.ru', 10);
$maria = new Applicant('Maria', 'm@mail.ru', 7);
$victor = new Applicant('Victor', 'v@mail.ru', 3);

$john->attachToSubject($hh);
$victor->attachToSubject($hh);

$hh->notify();


