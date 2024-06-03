<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

    const CREATED_AT = 'pr_createdAt';
    const UPDATED_AT = 'pr_updatedAt';

    protected $primaryKey = 'pr_id';
    protected $table = 'role';
    protected $fillable = ['pr_code', 'pr_name'];
    protected $hidden = ['pp_createdAt', 'pp_updatedAt'];
}
