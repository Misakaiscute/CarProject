<?php

require 'CarsInterface.php';
require 'DB.php';
class DBModels extends DB implements CarsInterface
{

    public function createDB(array $data): ?int
    {
        $this->mysqli->query("CREATE OR REPLACE TABLE models(id INT PRIMARY KEY AUTO_INCREMENT, id_manufacturer INT(50), name VARCHAR(50))");

        foreach ($data as $manufacturerId => $models){
            foreach ($models as $oneModel){
                $this->mysqli->query("INSERT INTO manufacturers (id_manufacturer, name) VALUES ($manufacturerId, $oneModel)");
            }
        }
    }
    public function get(int $id): array
    {
        $sql = "SELECT * FROM models WHERE id = $id";

        return $this->mysqli->query($sql)->fetch_assoc(MYSQLI_ASSOC);
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM models ORDER BY id";

        return $this->mysqli->query($sql)->fetch_assoc(MYSQLI_ASSOC);
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }
    public function getABC() : array{
        $sql = "SELECT DISTINCT SUBSTRING(name, 1, 1) AS ch FROM models";

        return $this->mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
    }
    public function getByFirstCh($ch) : array{
        $sql = "SELECT * FROM models WHERE name LIKE '$ch%' ORDER BY name";

        return $this->mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
    }
    public function getCount() : int{
        $sql = "SELECT COUNT(*) AS Count FROM models";

        $result = $this->mysqli->query($sql)->fetch_assoc();

        return $result['Count'];
    }
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM models WHERE id = $id";

        return $this->mysqli->query($sql);
    }
    public function truncate(){
        $sql = "TRUNCATE TABLE models";

        $result = $this->mysqli->query($sql);
    }
}