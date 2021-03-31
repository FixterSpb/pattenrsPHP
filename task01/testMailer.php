<?php

include_once "./SMSMailer.php";
include_once "./CNMailer.php";
include_once "./EMailer.php";
include_once "./Mailer.php";

function messageSend($message){
    $mailer =
        new SMSMailer(
            new CNMailer(
                new EMailer(
                    new Mailer($message)
                )
            )
        );

    echo "Рассылка сообщений:" . PHP_EOL;
    $mailer->send();
}

messageSend("Hello world!");