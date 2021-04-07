<?php


namespace app\src\commands;


abstract class CanceledCommand extends Command
{
    abstract public function unExecute($text): string;
}