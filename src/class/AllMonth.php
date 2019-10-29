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
    public function all_number_of_event($event)
    {
        $findEvent = $this->connectionDatabase->find(
            "SELECT count(event) as total FROM calendar WHERE event=:event AND id_calendar='{$this->id_calendar}'",
            array(":event"=>$event)
        );
        [$numero] = $findEvent;

        return $numero["total"];
    }
    public function number_of_event($event, $between)
    {
        $caseSchoolYears = $event == "letivo" ?
        "OR event LIKE '%bimestre' AND calendar_date BETWEEN $between"
        : "";
        $findEvent = $this->connectionDatabase->find(
            "SELECT count(event) as total FROM calendar WHERE event=:event AND calendar_date BETWEEN $between $caseSchoolYears AND id_calendar='{$this->id_calendar}'",
            array(":event"=>$event)
        );
        [$numero] = $findEvent;
        return $numero["total"];
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
    private function setAttribute($date_complete, $attribute, $day)
    {
        if(empty($attribute))
        {
            $check_sabadoDomingo = date("w", strtotime($date_complete));
            if(in_array($check_sabadoDomingo, array( 0, 6 )))
            {
                $id_attribute = "id='sabado_domingo'";
            }
            else{
                $id_attribute = '';
            }
        }
        else
        {
            $id_attribute = "id='{$attribute}'";
        }

        return "<div class='day' {$id_attribute} day date='$date_complete'>{$day}</div>";
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

            echo $this->setAttribute($date_complete, $attribute, $i);

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
                echo "<div class='tam60'>";
                echo "</div>";
                echo "<div class='tam40'>";
                    echo "<span school_years>";
                        $monthNumber = $this->numberMonth < 10 ? '0' . $this->numberMonth : $this->numberMonth;
                        $dayNumber = $this->number_of_days < 10 ? '0' . $this->number_of_days : $this->number_of_days;
                        $between = "'2020-{$monthNumber}-01' AND '2020-{$monthNumber}-{$dayNumber}'";
                        echo $this->number_of_event("letivo", $between);
                    echo "</span>";
                    echo " Dias Letivos";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
}
?>