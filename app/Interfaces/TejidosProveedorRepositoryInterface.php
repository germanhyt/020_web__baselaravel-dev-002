<?php

namespace App\Interfaces;

interface TejidosProveedorRepositoryInterface
{
    //

    public function getAll();
    public function getByTejido($id);
    public function getById($id);
    public function store(array $data);
    public function storeArray(array $data);
    public function update(array $data, $id);
    public function updateArrayByTejido(array $data, $id);
    public function updatePartial($id, $data);
    public function destroy($id);
}
