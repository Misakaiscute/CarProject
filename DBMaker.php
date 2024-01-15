<?php

require 'CarsInterface.php';
require 'DB.php';
class DBMaker extends DB implements CarsInterface
{
    public function createDB(array $data) : ?int{
        $this->mysqli->query("CREATE OR REPLACE TABLE TABLE manufacturers(id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(50))");

        foreach ($data as $oneData){
            $this->mysqli->query("INSERT INTO manufacturers (name) VALUES ($oneData)");
        }
    }
    public function get(int $id) : array{
        $sql = "SELECT * FROM manufacturers WHERE id = $id";

        return $this->mysqli->query($sql)->fetch_assoc(MYSQLI_ASSOC);
    }
    public function getAll() : array{
        $sql = "SELECT * FROM manufacturers ORDER BY name";

        return $this->mysqli->query($sql)->fetch_assoc(MYSQLI_ASSOC);
    }
    public function getByName(string $name) : array{
        $sql = "SELECT * FROM manufacturers WHERE name = $name";
        $result[] = $this->mysqli->query($sql);

        return $result;
    }
    public function update(int $id, array $data){
        $sql = "UPDATE manufacturers SET $data WHERE id = $id";
        $this->mysqli->query($sql);

        return $this->get($id);
    }
    public function delete(int $id) : bool{
        $sql = "DELETE FROM manufacturers WHERE id = $id";

        return $this->mysqli->query($sql);
    }
    public function getABC() : array{
        $sql = "SELECT DISTINCT SUBSTRING(name, 1, 1) AS ch FROM manufacturers";

        return $this->mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
    }
    public function getByFirstCh($ch) : array{
        $sql = "SELECT * FROM manufacturers WHERE name LIKE '$ch%' ORDER BY name";

        return $this->mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
    }
    public function getCount() : int{
        $sql = "SELECT COUNT(*) AS Count FROM manufacturers";

        $result = $this->mysqli->query($sql)->fetch_assoc();

        return $result['Count'];
    }
    public function truncate(){
        $sql = "TRUNCATE TABLE manufacturers";

        $this->mysqli->query($sql);
    }
}
