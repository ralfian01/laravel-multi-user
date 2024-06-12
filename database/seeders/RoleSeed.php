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
            ['pr_code' => 'ROOT_ADMIN', 'pr_name' => 'Root Admin'],
            ['pr_code' => 'ADMIN', 'pr_name' => 'Admin'],
            ['pr_code' => 'MEMBER', 'pr_name' => 'Member']
        ];

        DB::table('role')->insert($roleData);

        // Seed role privilege
        $rolePrivilegeData = [
            ['pr_id' => 1, 'pp_id' => 1],
            ['pr_id' => 1, 'pp_id' => 2],
            ['pr_id' => 1, 'pp_id' => 3],
            ['pr_id' => 1, 'pp_id' => 4],
            ['pr_id' => 1, 'pp_id' => 5],
            ['pr_id' => 1, 'pp_id' => 6],
            ['pr_id' => 1, 'pp_id' => 7],

            ['pr_id' => 2, 'pp_id' => 1],
            ['pr_id' => 2, 'pp_id' => 2],
            ['pr_id' => 2, 'pp_id' => 3],
        ];

        DB::table('role__privilege')->insert($rolePrivilegeData);
    }
}
