<?php

namespace Cars;

use Cars\CarsInterface;
class DBMaker extends \DB implements CarsInterface
{
    public function create(array $data) : ?int{
        $sql = "INSERT INTO Manufacturers $data";
        $this->mysqli->query($sql);

        $lastInserted = $this->mysqli->query("SELECT LAST_INSERT_ID() id;")->fetch_assoc();

        return $lastInserted['id'];
    }
    public function get(int $id) : array{

    }
    public function getAll() : array{
        $sql = "SELECT * FROM manufacturers ORDER BY name";

        return $this->mysqli->query($sql)->fetch_assoc(MYSQLI_ASSOC);
    }
    public function getByName(string $name) : array{
        $sql = "SELECT * FROM manufacturers WHERE name = $name";
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

        return $this->mysqli->guery($sql)->fetch_all(MYSQLI_ASSOC);
    }
    public function getByFirstCh($ch){
        $sql = "SELECT * FROM manufacturers WHERE name LIKE '$ch%' ORDER BY name";

        return $this->mysqli->query($sql)->fetch_assoc(MYSQLI_ASSOC);
    }
}
