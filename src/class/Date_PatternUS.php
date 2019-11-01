<?php
    class Date_PatternUS implements IPattern{
        public function timestamp_replace($timestamp)
        {
            return date("Y-m-d H:i:s", strtotime($date));
        }
        public function date_replace($date)
        {
            return date("Y-m-d", strtotime($date));
        }
    }
?>