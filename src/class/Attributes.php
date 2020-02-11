<?php
include_once('LoadClass.php');
class Attributes{
    private $id_calendar;
    private $connectionDatabase;
    private $event;

    function __construct($id_calendar)
    {
        $this->id_calendar = $id_calendar;
        $this->connectionDatabase = new ConnectionDatabase();
    }

    private function getMonth()
    {
        $contentMonth = file_get_contents("data". DIRECTORY_SEPARATOR ."month.json");
        return json_decode($contentMonth, true);
    }
    private function getEvent()
    {
        $contentMonth = file_get_contents("data". DIRECTORY_SEPARATOR ."events.json");
        return json_decode($contentMonth, true);
    }
    public function number_of_event($event, $between)
    {
        $caseSchoolYears = $event == "letivo" ?
        "OR event LIKE '%bimestre' AND calendar_date BETWEEN $between AND id_calendar='{$this->id_calendar}'"
        : "";

        $findEvent = $this->connectionDatabase->find(
            "SELECT count(event) as total FROM calendar WHERE event=:event AND calendar_date BETWEEN $between AND id_calendar='{$this->id_calendar}' $caseSchoolYears",
            array(":event"=>$event)
        );
        [$numero] = $findEvent;
        return $numero["total"];
    }
    
    public function number_of_event_for_month($event){
        $array_between = array_map(function ($e){
            $this->event = $GLOBALS["event"];

            $month = $e["number"] < 10 ? "0" . $e["number"] : $e["number"];
            $between = "'2020-{$month}-01' AND '2020-{$month}-{$e["number_of_days"]}'";
    
            $caseSchoolYears = $this->event == "letivo" ?
            "OR event LIKE '%bimestre' AND calendar_date BETWEEN $between  AND id_calendar='{$this->id_calendar}'"
            : "";
            $findEvent = $this->connectionDatabase->find(
                "SELECT count(event) as total FROM calendar WHERE event LIKE :event AND calendar_date BETWEEN $between  AND id_calendar='{$this->id_calendar}' $caseSchoolYears",
                array(":event"=>$this->event)
            );

            [$numero] = $findEvent;
            return array(
                "event" => $this->event,
                "total" => $numero["total"]
            );
        }, $this->getMonth());
    
        return $array_between;
    }
    
    public function number_of_event_for_year($event){
        $caseSchoolYears = $event == "letivo" ?
            "OR event LIKE '%bimestre' AND id_calendar='{$this->id_calendar}'"
            : null;
            
        $findEvent = $this->connectionDatabase->find(
            "SELECT count(event) as total FROM calendar WHERE event=:event AND id_calendar='{$this->id_calendar}' $caseSchoolYears",
            array(":event"=>$event)
        );
    
        [$numero] = $findEvent;
        return $numero["total"];
    }
    public function number_and_data_event_for_month($event){
        $array_between = array_map(function ($e){
            $this->event = $GLOBALS["event"];

            $month = $e["number"] < 10 ? "0" . $e["number"] : $e["number"];
            $between = "'2020-{$month}-01' AND '2020-{$month}-{$e["number_of_days"]}'";

            $findEvent = $this->connectionDatabase->find(
                "SELECT event, calendar_date as data FROM calendar WHERE event LIKE :event AND calendar_date BETWEEN $between  AND id_calendar='{$this->id_calendar}' ORDER BY calendar_date",
                array(":event"=>$this->event)
            );

            return $findEvent;
        }, $this->getMonth());
    
        return $array_between;
    }
    public function attributes_distinct(){
        $findEvent = $this->connectionDatabase->find(
            "SELECT DISTINCT event FROM calendar WHERE id_calendar=:id ORDER BY event",
            array(":id"=>$this->id_calendar)
        );

        return $findEvent;
    }
}
?>