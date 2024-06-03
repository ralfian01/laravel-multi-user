<?php

namespace App\Console\Commands;

use App\Models\RoleModel;
use Exception;
use Illuminate\Console\Command;

class RoleDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:delete {id_or_code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id_or_code');

        $accept = $this->ask("remove role? \n data in the accounts tables will be affected \n [y/n] [default: n]") ?? 'n';
        if ($accept == 'n') {
            return $this->alert('delete canceled');
        }

        // Find by id or code
        $role = RoleModel::where('pr_id', '=', $id)
            ->orWhere('pr_code', 'LIKE', "%{$id}%");

        if (!$role->exists()) {
            return $this->error('Data not found');
        }

        $role = $role->first();

        try {
            $role->delete();
            $this->info('Role deleted');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
