<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'pa_uuid' => Uuid::uuid4()->toString(),
            'pa_username' => 'user_1@app.com',
            'pa_password' => hash('sha256', '123456'),
            'pr_id' => 2,
            'pa_deletable' => true,
            'pa_statusActive' => true,
            'pa_statusDelete' => false,
        ];

        DB::table('account')->insert($data);
    }
}
