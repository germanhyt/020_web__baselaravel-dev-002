<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    // Prototype methods
    public function login(array $data);
    public function register(array $data);
    public function getAll();
}
