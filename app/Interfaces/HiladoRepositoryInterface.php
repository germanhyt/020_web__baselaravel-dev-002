<?php

namespace App\Interfaces;

interface HiladoRepositoryInterface
{
    //

    public function getAll();
    public function getById($id);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function updatePartial(array $data, $id);

    public function getPaginated($perPage);
    public function filter($field, $query, $perPage);
    public function filters(array $filters, $perPage);
}
