<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function login(array $data)
    {
        // Logic to login user
        return User::where('email', $data['email'])->first();
    }


    public function register(array $data)
    {
        // Logic to register user
        return User::create($data);
    }

    public function getAll()
    {
        // Logic to get all users
        return User::all();
    }
}
