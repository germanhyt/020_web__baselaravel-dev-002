<?php

namespace App\Interfaces;

interface HiladosproveedorRepositoryInterface
{
    //
    public function getAll();
    public function getByHilado($id);
    public function getById($id);
    public function store(array $data);
    public function storeArray(array $data);
    public function update(array $data, $id);
    public function updateArrayByHilado(array $data, $id);
    public function destroy($id);
    public function updatePartial(array $data, $id);
}
