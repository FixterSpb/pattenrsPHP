<?php


namespace app\src;
/**
 * @static
 */
final class Clipboard
{
    protected static ?Clipboard $instance= null;
    private string $text = '';

    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}

    public static function getInstance() :Clipboard{
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function set(string $text){
        $this->text = $text;
    }

    public function get(){
        return $this->text;
    }

    public function length(){
        return mb_strlen($this->text);
    }
}