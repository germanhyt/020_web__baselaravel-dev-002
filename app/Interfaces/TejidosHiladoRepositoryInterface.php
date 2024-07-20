<?php

namespace App\Interfaces;

interface TejidosHiladoRepositoryInterface
{
    //
    public function getAll();
    public function getById($id);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
    public function updatePartial($id, array $data);
}
