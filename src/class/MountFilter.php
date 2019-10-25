<?php
include_once('LoadClass.php');
class MountFilter{
    private $header;
    private $field;
    private $tbl;

    private function nameField()
    {
        $conn = new ConnectionDatabase();
        $this->header = $conn->find(
            "SELECT $this->field FROM $this->tbl limit 1",
            null);
    }
    public function filter($tbl, $field)
    {
        $this->tbl = $tbl;
        $this->field = $field;
        $this->nameField();

        foreach ($this->header as $line)
        {
            foreach($line as $key_field => $value_field)
            {
                echo "<option value='$key_field'>$key_field</option>";
            }
        }
        return ;
    }
}
?>