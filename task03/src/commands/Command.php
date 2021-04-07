<?php

namespace app\src\commands;
use app\src\Clipboard;

abstract class Command implements ICommand
{
    protected int $start;
    protected ?int $end;
    protected Clipboard $clipboard;

    public function __construct(int $start, ?int $end =null){

        $this->end = $end;
        $this->start = $start - 1;
        $this->clipboard = Clipboard::getInstance();
    }


}