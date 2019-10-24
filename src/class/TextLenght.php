<?php

class TextLenght{
    public function replace_text($text)
    {
        $response = strlen($text) > 20 ? substr($text, 0, 25) . "..." : $text;
        return $response;
    }
}

?>