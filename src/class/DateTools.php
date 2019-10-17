<?php
class DatesTools{
    public function convertPattern($date, IPattern $Pattern)
    {
        return $Pattern->date_replace($date);
    }
}
?>