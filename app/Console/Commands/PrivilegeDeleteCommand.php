<?php

namespace App\Console\Commands;

use App\Models\PrivilegeModel;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;

class PrivilegeDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'privilege:delete {id_or_code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete privilege';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id_or_code');

        $accept = $this->ask("remove privileges? \n data in the roles and accounts tables will be affected \n [y/n] [default: n]") ?? 'n';
        if ($accept == 'n') {
            return $this->alert('delete canceled');
        }

        try {
            // Find by id or code
            $find = PrivilegeModel::where('pp_id', '=', $id)
                ->orWhere('pp_code', 'LIKE', "%{$id}%")
                ->get();

            $find = $find[0];

            $privilege = PrivilegeModel::find($find['pp_id']);
            if (!$privilege) {
                throw new Exception('data not found');
            }

            $privilege->delete();
            $this->info('Privilege deleted');
        } catch (QueryException $e) {
            $this->error($e->getMessage());
        } catch (Exception $e) {
            $this->alert($e->getMessage());
        }
    }
}
