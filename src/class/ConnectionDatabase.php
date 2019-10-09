<?php

class ConnectionDatabase{
    private $connection;
    private $recebe;

    public function __construct()
    {
        try {
            $this->connection = new PDO("pgsql:host=localhost, dbname=semec","postgres","p21s11b96");
        } catch (PDOException $erro) {
             throw new Exception("Erro no banco de dados {$erro}", 1);
        }
    }

    private function bindParameters($params)
    {
        foreach ($params as $key => $value)
        {
            $this->recebe->bindParam($key, $value);   
        }
    }
    private function verification($condition)
    {
        return $condition ? '{"message":true}' : '{"message":false}';
    }

    public function insert($stmt, $param)
    {
        $this->recebe = $this->connection->prepare($stmt);
        $this->bindParameters($param);
        $this->recebe->execute();
        return $this->verification($this->recebe->rowCount());
    }

    public function find($stmt, $param)
    {
        $this->recebe = $this->connection->prepare($stmt);
        $this->bindParameters($param);
        $this->recebe->execute();
        return $this->recebe->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($stmt, $param)
    {
        $this->recebe = $this->connection->prepare($stmt);
        $this->bindParameters($param);
        $this->recebe->execute();
        return $this->verification($this->recebe->rowCount());
    }

    public function delete($stmt, $param)
    {
        $this->recebe = $this->connection->prepare($stmt);
        $this->bindParameters($param);
        $this->recebe->execute();
        return $this->verification($this->recebe->rowCount());
    }
}
?>