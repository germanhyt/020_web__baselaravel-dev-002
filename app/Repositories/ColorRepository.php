<?php

namespace App\Repositories;

use App\Interfaces\ColorRepositoryInterface;
use App\Models\Color;

class ColorRepository implements ColorRepositoryInterface
{
    // 
    public function getAll()
    {
        return Color::all();
    }
}
