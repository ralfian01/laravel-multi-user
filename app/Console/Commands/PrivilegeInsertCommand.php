<?php

namespace App\Console\Commands;

use App\Models\PrivilegeModel;
use Exception;
use Illuminate\Console\Command;

class PrivilegeInsertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'privilege:insert {code} {description}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert new privilege';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [];
        $data['pp_code'] = $this->argument('code');
        $data['pp_description'] = $this->argument('description') ?? '';

        try {
            PrivilegeModel::insert($data);
            $this->info('Privilege inserted');
        } catch (Exception $e) {
            $this->alert($e->getMessage());
        }
    }
}
