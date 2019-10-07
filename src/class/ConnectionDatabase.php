<?php

class ConnectionDatabase{
    private $connection;
    public function connect()
    {
        try {
            $this->connection = new PDO("pgsql:host=localhost, dbname=semec","postgres","p21s11b96");
             return $this->connection;
        } catch (PDOException $erro) {
            echo $erro;
             return false;
        }
    }
}
?>