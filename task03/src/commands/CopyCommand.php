<?php


namespace app\src\commands;


class CopyCommand extends Command
{

    public function execute(string $text): string
    {
        $subString = mb_substr($text, $this->start, $this->end - $this->start);
        $this->clipboard->set($subString);
        return $text;
    }
}