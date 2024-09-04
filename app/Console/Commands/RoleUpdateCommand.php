<?php

namespace App\Console\Commands;

use App\Models\PrivilegeModel;
use App\Models\RoleModel;
use App\Models\RolePrivilegeModel;
use Exception;
use Illuminate\Console\Command;

class RoleUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:update
                            {id_or_code}
                            {--code=}
                            {--name=}
                            {--delete-privileges=}
                            {--add-privileges=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get id
        $id = $this->argument('id_or_code');

        // Collect input
        $input = array_filter(
            [
                'pr_code' => $this->option('code') ?? null,
                'pr_name' => $this->option('name') ?? null,
            ],
            // Remove null value
            fn($value) => !is_null($value)
        );

        if (empty($input) && empty($this->options())) {
            return $this->warn('No data updated');
        }

        // Find by id or code
        if (is_numeric($id)) {
            $role = RoleModel::where('pr_id', $id);
        } else {
            $role = RoleModel::where('pr_code', 'LIKE', "%{$id}%");
        }

        // If data does not exist
        if (!$role->exists()) {
            return $this->warn('Data not found');
        }

        // Select first row
        $role = $role->first();

        // Try update data
        try {
            $role->update($input);
            $this->info('Role updated');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }


        // Add privileges
        if ($this->option('add-privileges') != null) {
            $optPrivilege = explode(',', str_replace(' ', '', $this->option('add-privileges')));

            $addPrv = $this->addPrivilege($role['pr_id'], $optPrivilege);

            if (!$addPrv->status) {
                return $this->warn($addPrv->message);
            }

            $this->info($addPrv->message);
        }


        // Delete privileges
        if ($this->option('delete-privileges') != null) {
            $optPrivilege = explode(',', str_replace(' ', '', $this->option('delete-privileges')));

            $delPrv = $this->delPrivilege($role['pr_id'], $optPrivilege);

            if (!$delPrv->status) {
                return $this->warn($delPrv->message);
            }

            $this->info($delPrv->message);
        }
    }

    /**
     * Add privilege for role
     * @param array $privileges Array or selected privileges
     * @return object
     */
    private function addPrivilege($roleId, array $privileges = [])
    {
        $checkPrivilege = $this->checkPrivilege($privileges);

        if (!$checkPrivilege->status) {
            return (object) [
                'status' => false,
                'message' => $checkPrivilege->message,
            ];
        }

        $addPrivilege = $checkPrivilege->data;

        // Insert role privilege
        $rolePrivilege = [];

        foreach ($addPrivilege as $id) {
            $rolePrivilege[] = [
                'pr_id' => $roleId,
                'pp_id' => $id
            ];
        }

        // Try to insert data
        try {
            RolePrivilegeModel::insert($rolePrivilege);
        } catch (Exception $e) {
            switch ($e->getCode()) {
                case '23000':
                    return (object) [
                        'status' => false,
                        'message' => "The role already has these access rights",
                    ];
                    break;
                default:
                    return (object) [
                        'status' => false,
                        'message' => $e->getMessage(),
                    ];
                    break;
            }
        }

        return (object) [
            'status' => true,
            'message' => 'Role privilege added',
        ];
    }

    /**
     * Delete privilege for role
     * @param array $privileges Array or selected privileges
     * @return object
     */
    private function delPrivilege($roleId, array $privileges = [])
    {
        $checkPrivilege = $this->checkPrivilege($privileges);

        if (!$checkPrivilege->status) {
            return (object) [
                'status' => false,
                'message' => $checkPrivilege->message,
            ];
        }

        $privilegeIds = $checkPrivilege->data;

        // Try to delete data
        try {
            RolePrivilegeModel::where('pr_id', $roleId)
                ->whereIn('pp_id', $privilegeIds)
                ->delete();
        } catch (Exception $e) {
            return (object) [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }

        return (object) [
            'status' => true,
            'message' => 'Role privilege deleted',
        ];
    }

    /**
     * Check privileges
     * @return object
     */
    private function checkPrivilege(array $arrPriv = [])
    {
        // Check privilege availability
        $numPriv = [];
        $codePriv = [];
        foreach ($arrPriv as $priv) {
            if (is_numeric($priv)) {
                $numPriv[] = $priv;
            } else {
                $codePriv[] = $priv;
            }
        }

        $privilege = PrivilegeModel::whereIn('pp_id', $numPriv)
            ->orWhereIn('pp_code', $codePriv)
            ->get(['pp_id', 'pp_code'])
            ->toArray();

        // Make sure id or code available
        $foundIds = array_column($privilege, 'pp_id');
        $foundCodes = array_column($privilege, 'pp_code');

        $missingIds = array_diff(
            $arrPriv,
            array_merge($foundIds, $foundCodes)
        );

        if (!empty($missingIds)) {
            return (object) [
                'status' => false,
                'message' => 'The following IDs are not available: ' . implode(', ', $missingIds),
            ];
        }

        return (object) [
            'status' => true,
            'data' => $foundIds, // Return id
        ];
    }
}
