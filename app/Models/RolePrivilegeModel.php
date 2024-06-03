<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePrivilegeModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'prp_id';
    protected $table = 'role__privilege';
    protected $fillable = ['pr_id', 'pp_id'];
}
