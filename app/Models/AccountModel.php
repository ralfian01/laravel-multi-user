<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static mixed getWithPrivileges() Get account with its privileges
 * @method mixed getWithPrivileges() Get account with its privileges
 */
class AccountModel extends Model
{
    use HasFactory;

    const CREATED_AT = 'pa_createdAt';
    const UPDATED_AT = 'pa_updatedAt';

    protected $primaryKey = 'pa_id';
    protected $table = 'account';
    protected $fillable = [
        'pa_uuid', 'pa_username', 'pa_password', 'pr_id', 'pa_statusActive', 'pa_statusDelete',
    ];
    protected $hidden = [
        'pa_createdAt', 'pa_updatedAt', 'pa_password'
    ];

    /**
     * Relation with table role
     */
    public function accountRole()
    {
        return $this->belongsTo(RoleModel::class, 'pr_id');
    }

    /**
     * Privilege from relation between account, account__privilege and privilege tables
     */
    public function accountPrivilege()
    {
        return $this->belongsToMany(PrivilegeModel::class, 'account__privilege', 'pa_id', 'pp_id');
    }

    /**
     * Get account with its privileges
     */
    protected function scopeGetWithPrivileges(Builder $query)
    {
        return $query
            ->with(['accountPrivilege', 'accountRole.rolePrivilege'])
            ->addSelect(['pa_id', 'pr_id'])
            ->get()
            ->map(function ($acc) {

                $acc->makeHidden(['accountPrivilege', 'accountRole']);

                if (isset($acc->accountPrivilege)) {
                    $acc->privileges = $acc->accountPrivilege->map(function ($prv) {
                        return $prv->pp_code;
                    })->toArray();
                }

                if (isset($acc->accountRole->rolePrivilege)) {
                    $acc->privileges = array_unique(
                        $acc->accountRole->rolePrivilege->map(function ($prv) {
                            return $prv->pp_code;
                        })->toArray()
                    );
                }

                return $acc;
            });
    }
}
