<?php

use Cars\CarsInterface;

class DBModels extends \DB implements CarsInterface
{

    public function create(array $data): ?int
    {
        // TODO: Implement create() method.
    }

    public function get(int $id): array
    {
        // TODO: Implement get() method.
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }
}