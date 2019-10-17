<?php
    class Date_PatternBR implements IPattern{
        public function date_replace($date)
        {
            $date_replace = date("d/m/Y H:i:s", strtotime($date));
            return $date_replace;
        }

    }
?>