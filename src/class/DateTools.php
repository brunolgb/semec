<?php
class DatesTools{
    public function convertPattern($type, $date, IPattern $Pattern)
    {
        if($type == "timestamp")
        {
            return $Pattern->timestamp_replace($date);
        }
        else
        {
            return $Pattern->date_replace($date);
        }
    }
}
?>