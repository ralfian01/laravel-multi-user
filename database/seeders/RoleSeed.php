<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed role
        $roleData = [
            ['tr_code' => 'ROOT_ADMIN', 'tr_name' => 'Root Admin'],
            ['tr_code' => 'ADMIN', 'tr_name' => 'Admin'],
            ['tr_code' => 'MEMBER', 'tr_name' => 'Member']
        ];

        DB::table('role')->insert($roleData);

        // Seed role privilege
        $rolePrivilegeData = [
            ['tr_id' => 1, 'tp_id' => 1],
            ['tr_id' => 1, 'tp_id' => 2],
            ['tr_id' => 1, 'tp_id' => 3],
            ['tr_id' => 1, 'tp_id' => 4],
            ['tr_id' => 1, 'tp_id' => 5],
            ['tr_id' => 1, 'tp_id' => 6],
            ['tr_id' => 1, 'tp_id' => 7],

            ['tr_id' => 2, 'tp_id' => 1],
            ['tr_id' => 2, 'tp_id' => 2],
            ['tr_id' => 2, 'tp_id' => 3],
        ];

        DB::table('role__privilege')->insert($rolePrivilegeData);
    }
}
