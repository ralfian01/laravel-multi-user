<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleViewModel extends Model
{
    use HasFactory;

    protected $table = 'role__vw';
    protected $fillable = [];
}
