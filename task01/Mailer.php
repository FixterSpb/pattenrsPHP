<?php

include_once "./IMailer.php";

class Mailer implements IMailer
{
    protected string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function send()
    {
        return $this->message;
    }
}