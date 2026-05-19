<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Permitimos la asignación masiva para el campo name
    protected $fillable = ['name'];
}