<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivilegeModel extends Model
{
    use HasFactory;

    const CREATED_AT = 'pp_createdAt';
    const UPDATED_AT = 'pp_updatedAt';

    protected $primaryKey = 'pp_id';
    protected $table = 'privilege';
    protected $fillable = ['pp_code', 'pp_description'];
    protected $hidden = ['pp_createdAt', 'pp_updatedAt'];
}
