<?php
include_once('ConnectionDatabase.php');
class Insert{
    private $connection;
    private $instance;
    private $recebe;

    public function inserting($stmt, $param)
    {
        $this->connection = new ConnectionDatabase();
        $this->instance = $this->connection->connect();
        $this->recebe = $this->instance->prepare($stmt);

        foreach ($param as $key => $value)
        {
            echo $value . "<br>";
            $this->recebe->bindParam($key, $value);
        }
        
        if($this->recebe->execute())
        {
            return true;
        }
        else{
            return false;
        }
    }
}
?>