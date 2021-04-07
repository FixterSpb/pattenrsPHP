<?php

namespace app\src\commands;

class CutCommand extends CanceledCommand
{
    private string $subString = '';

    public function execute(string $text): string
    {
        $this->subString = mb_substr($text, $this->start, $this->end - $this->start);
        $this->clipboard->set($this->subString);
        return mb_substr($text, 0, $this->start) .  mb_substr($text, $this->end);
    }

    public function unExecute($text): string
    {
        return mb_substr($text, 0, $this->start) .  $this->subString . mb_substr($text, $this->start);
    }
}