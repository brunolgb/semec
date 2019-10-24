<?php
    class Date_PatternBR implements IPattern{
        public function timestamp_replace($timestamp)
        {
            return date("d/m/Y H:i:s", strtotime($timestamp));
        }
        public function date_replace($date)
        {
            return date("d/m/Y", strtotime($date));
        }

    }
?>