<?php
use Exception;
class MakerDbTools {
    const DBTABLE = 'makers';
    private $mysqli;

    function __construct($host = 'localhost', $user = 'root', $password = null, $db = 'car_php'){
        $this->mysqli = new mysqli($host, $user, $password, $db);
        if ($this->mysqli->connect_error){
            throw new Exception($this->mysqli->connect_error);
        }
    }
    function createMaker($maker){
        $result = $this->mysqli->query("INSERT INTO makers (name) VALUES ('$maker')");
        if (!$result) {echo "Hiba történt a" . $maker . "beszúrása során."; return false;}

        return $result;
    }
    function updateMaker($data){
        $makerName = $data['name'];
        $result = $this->mysqli->query("UPDATE makers SET {$data['name']}");

        if (!$result) {echo "Hiba a" . $makerName . "frissítése közben"; return $result;}

        $maker = getMakerByName($makerName);

        return $maker;
    }
    function getMakerByName($name){
        $sql = "SELECT name FROM maker WHERE name=$name";
        $result = $this->mysqli->query($sql);
        $maker = $result->fetch_assoc();

        return $maker;
    }
    function delMaker($id){
        $result = $this->mysqli->query("DELETE makers WHERE id=$id");
    }
    function getAllMakers(){
        $result = $this->mysqli->query("SELECT * FROM makers");

        return $result;
    }
    function __destruct()
    {
        $this->mysqli->close();
    }
}