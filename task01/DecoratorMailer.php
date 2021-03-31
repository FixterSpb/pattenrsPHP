<?php

include_once "./IMailer.php";


abstract class DecoratorMailer implements IMailer
{
    protected ?IMailer $mailer;

    public function __construct(IMailer $mailer)
    {
        $this->mailer = $mailer;
    }
}