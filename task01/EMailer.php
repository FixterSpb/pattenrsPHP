<?php

include_once "./DecoratorMailer.php";

class EMailer extends DecoratorMailer
{

    public function send()
    {
        $message = $this->mailer->send();
        // Вместо echo - какая-то логика отправки сообщения
        echo "Данное сообщение отправлено по Email: " . $message . PHP_EOL;
        return $message;
    }
}