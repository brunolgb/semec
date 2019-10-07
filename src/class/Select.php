<?php
include_once('ConnectionDatabase.php');
class Select{
    private $connection;
    private $instance;
    private $recebe;

    public function findAll($stmt, $param)
    {
        $this->connection = new ConnectionDatabase();
        $this->instance = $this->connection->connect();
        $this->recebe = $this->instance->prepare($stmt);

        foreach ($param as $key => $value)
        {
            $this->recebe->bindParam($key, $value);
        }
        
        $this->recebe->execute();
        return $this->recebe->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>