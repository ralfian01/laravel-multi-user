<?php

namespace App\Console\Commands;

use App\Models\PrivilegeModel;
use Illuminate\Console\Command;

class PrivilegeViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'privilege:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get list of privileges';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = PrivilegeModel::all();

        if ($data->isEmpty()) {
            $this->info('No data found');
        } else {
            $this->table(
                ['id', 'code', 'description'],
                $data->map(function ($item) {
                    return [
                        $item->pp_id,
                        $item->pp_code,
                        $item->pp_description,
                    ];
                })->toArray()
            );
        }
    }
}
