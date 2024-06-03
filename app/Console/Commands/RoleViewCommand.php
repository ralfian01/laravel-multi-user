<?php

namespace App\Console\Commands;

use App\Models\RoleViewModel;
use Illuminate\Console\Command;

class RoleViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View list of roles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = RoleViewModel::all();

        if ($data->isEmpty()) {
            $this->info('No data found');
        } else {
            $this->table(
                ['id', 'code', 'name', 'privileges'],
                $data->map(function ($item) {
                    $item->prv_privilege = str_replace(['"', '[', ']'], '', $item->prv_privilege);
                    $item->prv_privilege = str_replace([','], ', ', $item->prv_privilege);
                    return [
                        $item->prv_id,
                        $item->prv_code,
                        $item->prv_name,
                        $this->wordWrap($item->prv_privilege, 25)
                    ];
                })
            );
        }
    }


    private function wordWrap($string, $width = 50)
    {
        return wordwrap($string, $width, "\n", true);
    }
}
