<?php


namespace app\src\commands;


class PasteCommand extends CanceledCommand
{
    private string $subString = '';
    private int $lengthPastedString;

    public function execute(string $text): string
    {
        if (!is_null($this->end) && $this->start <= $this->end) {
            $this->subString = mb_substr($text,  $this->start, $this->end - $this->start);
        }
        $this->lengthPastedString = $this->clipboard->length();

        return mb_substr($text, 0, $this->start) . $this->clipboard->get() . mb_substr($text, is_null($this->end) ? $this->start : $this->end);

    }

    public function unExecute($text): string
    {
        return mb_substr($text, 0, $this->start) . $this->subString .  mb_substr($text, $this->start + $this->lengthPastedString);
    }
}