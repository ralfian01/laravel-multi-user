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
            'ta_uuid' => Uuid::uuid4()->toString(),
            'ta_username' => 'user_1@app.com',
            'ta_password' => hash('sha256', '123456'),
            'tr_id' => 2,
            'ta_deletable' => true,
            'ta_statusActive' => true,
            'ta_statusDelete' => false,
        ];

        DB::table('account')->insert($data);
    }
}
