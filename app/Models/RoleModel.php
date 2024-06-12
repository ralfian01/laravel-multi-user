<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static mixed getWithPrivileges() Get role with its privileges
 * @method mixed getWithPrivileges() Get role with its privileges
 */
class RoleModel extends Model
{
    use HasFactory;

    const CREATED_AT = 'pr_createdAt';
    const UPDATED_AT = 'pr_updatedAt';

    protected $primaryKey = 'pr_id';
    protected $table = 'role';
    protected $fillable = ['pr_code', 'pr_name'];
    protected $hidden = ['pr_createdAt', 'pr_updatedAt'];

    /**
     * Privilege from relation between role, role__privilege, and privilege tables
     */
    public function rolePrivilege()
    {
        return $this->belongsToMany(PrivilegeModel::class, 'role__privilege', 'pr_id', 'pp_id');
    }

    /**
     * Get role with its privileges
     */
    protected function scopeGetWithPrivileges(Builder $query)
    {
        return $query
            ->with(['rolePrivilege'])
            ->addSelect(['pr_id'])
            ->get()
            ->map(function ($role) {

                $role->makeHidden(['rolePrivilege']);

                if (!is_null($role->rolePrivilege)) {
                    $role->privileges = $role->rolePrivilege->map(function ($privilege) {
                        return $privilege->pp_code;
                    })->toArray();
                }

                return $role;
            });
    }
}
