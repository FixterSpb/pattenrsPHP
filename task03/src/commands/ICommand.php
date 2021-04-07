<?php

namespace app\src\commands;

interface ICommand
{
    public function execute(string $text): string;
}