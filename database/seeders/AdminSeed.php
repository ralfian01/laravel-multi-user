<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'pa_uuid' => Uuid::uuid4()->toString(),
            'pa_username' => env('ROOT_ADMIN_USERNAME'),
            'pa_password' => hash('sha256', env('ROOT_ADMIN_PASSWORD')),
            'pr_id' => 1,
            'pa_metaDeletable' => false,
            'pa_metaStatusActive' => true,
            'pa_metaStatusDelete' => false,
        ];

        DB::table('pts_account')->insert($data);
    }
}
