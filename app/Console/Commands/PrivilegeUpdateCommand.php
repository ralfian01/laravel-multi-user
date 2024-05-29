<?php

namespace App\Console\Commands;

use App\Models\PrivilegeModel;
use Exception;
use Illuminate\Console\Command;

class PrivilegeUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'privilege:update {id_or_code}
                            {--code=}
                            {--description=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update privilege data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id_or_code');

        $data = [];

        if ($this->option('code') != null) $data['pp_code'] = $this->option('code');
        if ($this->option('description') != null) $data['pp_description'] = $this->option('description');

        if (count($data) <= 0) {
            return $this->alert('no data updated');
        }

        // Find by id or code
        $find = PrivilegeModel::where('pp_id', '=', $id)
            ->orWhere('pp_code', 'LIKE', "%{$id}%")
            ->get();

        $find = $find[0];

        $privilege = PrivilegeModel::find($find['pp_id']);
        if (!$privilege) {
            return $this->alert('data not found');
        }

        try {
            $privilege->update($data);
            $this->info('Privilege updated');
        } catch (Exception $e) {
            $this->alert($e->getMessage());
        }
    }
}
