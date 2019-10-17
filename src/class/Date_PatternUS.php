<?php
    class Date_PatternUS implements IPattern{
        public function date_replace($date)
        {
            $date_replace = date("Y-m-d H:i:s", strtotime($date));
            return $date_replace;
        }

    }
?>