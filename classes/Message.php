<?php
const MESSAGE = 'message';
class Message
{

    public $message;

    public function addMessage($message)
    {
        if (isset($_SESSION[MESSAGE])) {
            unset($_SESSION[MESSAGE]);
        }
        $_SESSION[MESSAGE] = $message;
        return $_SESSION[MESSAGE];
    }

    public function getMessage()
    {
        if (isset($_SESSION[MESSAGE])) {
            $message = $_SESSION[MESSAGE];
            unset($_SESSION[MESSAGE]);
            return $message;
        }
    }
}
