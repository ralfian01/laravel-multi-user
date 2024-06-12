<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPrivilegeModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'pap_id';
    protected $table = 'account__privilege';
    protected $fillable = ['pa_id', 'pp_id'];
}
