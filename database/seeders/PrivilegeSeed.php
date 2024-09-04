<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'tp_code' => 'ACCOUNT_MANAGE_VIEW',
                'tp_description' => 'View account list',
            ],
            [
                'tp_code' => 'ACCOUNT_MANAGE_SUSPEND',
                'tp_description' => 'Suspend or activate account',
            ],
            [
                'tp_code' => 'ACCOUNT_MANAGE_PRIVILEGE',
                'tp_description' => 'Set account privileges',
            ],
            [
                'tp_code' => 'ADMIN_MANAGE_VIEW',
                'tp_description' => 'View admin list',
            ],
            [
                'tp_code' => 'ADMIN_MANAGE_SUSPEND',
                'tp_description' => 'Suspend or activate admin',
            ],
            [
                'tp_code' => 'ADMIN_MANAGE_PRIVILEGE',
                'tp_description' => 'Set admin privileges',
            ],
            [
                'tp_code' => 'ADMIN_MANAGE_ADD',
                'tp_description' => 'Add or delete admin',
            ],
        ];

        DB::table('privilege')->insert($data);
    }
}
