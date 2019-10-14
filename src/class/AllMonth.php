<?php
include_once("ConnectionDatabase.php");

class AllMonth{
    public $json_monthAll;
    private $connectionDatabase;
    private $id_calendar;
    public $monthName;
    public $monthStart;
    public $number_of_days;
    public $numberMonth;
    private $number_of_whiteSpace;


    private function getJsonMonths()
    {
        $contentMonth = file_get_contents('../../data/month.json');
        $this->json_monthAll = json_decode($contentMonth, true);
    }
    private function blanckSpace()
    {
        $this->number_of_whiteSpace = $this->monthStart;
        for($white_space = 1; $white_space < $this->number_of_whiteSpace; $white_space++)
        {
            echo "<div class='day'></div>";    
        }
    }
    private function getAttributeDay($date)
    {
        $findDate = $this->connectionDatabase->find(
            "SELECT event FROM calendar WHERE calendar_date=:calendarDate AND id_calendar='{$this->id_calendar}'",
            array(":calendarDate"=>$date)
        );
        [$numero] = $findDate;

        return $numero["event"];
    }
    private function addDayinSemana()
    {
        $cont = 1;
        for($i = 1; $i <= $this->number_of_days; $i++)
        {
            $monthNumber = $this->numberMonth < 10 ? '0' . $this->numberMonth : $this->numberMonth;
            $day = $i < 10 ? '0' . $i : $i;
            $date_complete = "2020-{$monthNumber}-{$day}";
            $attribute = $this->getAttributeDay($date_complete);
            if(empty($attribute))
            {
                $attribute = '';
            }
            else{
                $attribute = "id='{$attribute}'";
            }
            echo "<div class='day' {$attribute} day date='$date_complete'>{$i}</div>";

            // numeros de controle
            $sem1 = (7 - $this->number_of_whiteSpace) + 1;
            $sem2 = (14 - $this->number_of_whiteSpace) + 1;
            $sem3 = (21 - $this->number_of_whiteSpace) + 1;
            $sem4 = (28 - $this->number_of_whiteSpace) + 1;
            $sem5 = (35 - $this->number_of_whiteSpace) + 1;

            if($cont == $sem1 or $cont == $sem2 or $cont == $sem3 or $cont == $sem4 or $cont == $sem5)
            {
                echo "</div>";
                echo "<div class='semana'>";
            }
            $cont++;
        }
    }
    public function mountDay()
    {
        echo "<div class='days tam100'>";
            echo "<div class='semana tam100'>";
                $this->blanckSpace();
                $this->addDayinSemana();
            echo "</div>";
        echo "</div>";
    }

    public function mountMonth($number, $id_calendar)
    {
        $this->id_calendar = $id_calendar;
        $this->connectionDatabase = new ConnectionDatabase();
        $this->getJsonMonths();
        $this->monthName = $this->json_monthAll[$number]["name"];
        $this->monthStart = $this->json_monthAll[$number]["start"];
        $this->number_of_days = $this->json_monthAll[$number]["number_of_days"];
        $this->numberMonth = $this->json_monthAll[$number]["number"];

        echo "<div class='month'>";
            echo "<div class='title-month'>";
                echo $this->monthName;
            echo "</div>";
            echo "<div class='semana title-semana'>";
                echo "<div class='day'>D</div>";
                echo "<div class='day'>S</div>";
                echo "<div class='day'>T</div>";
                echo "<div class='day'>Q</div>";
                echo "<div class='day'>Q</div>";
                echo "<div class='day'>S</div>";
                echo "<div class='day'>S</div>";
            echo "</div>";

            $this->mountDay();

            echo "<div class='month_information'>";
                echo "<div class='tam70'>";
                echo "</div>";
                echo "<div class='tam30'>";
                    echo "<span school_years>";
                        echo "--";
                    echo "</span>";
                    echo " Dias Letivos";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
}
?>