<?php
class Dates{
    private $timestamp;
    private $Pattern;

    function __construct($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function convertPattern(IPattern $pattern)
    {
        
    }
}
?>