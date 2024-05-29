<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegeSeed2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'pp_code' => 'ACCOUNT_MANAGE_VIEW',
                'pp_description' => 'Lihat daftar akun',
            ],
            [
                'pp_code' => 'ACCOUNT_MANAGE_SUSPEND',
                'pp_description' => 'Suspend atau aktifkan akun',
            ],
            [
                'pp_code' => 'ACCOUNT_MANAGE_PRIVILEGE',
                'pp_description' => 'Atur hak akses akun',
            ],
            [
                'pp_code' => 'MEMBER_MANAGE_VIEW',
                'pp_description' => 'Lihat daftar anggota/fotografer',
            ],
            [
                'pp_code' => 'MEMBER_MANAGE_SUSPEND',
                'pp_description' => 'Suspend atau aktifkan anggota/fotografer',
            ],
            [
                'pp_code' => 'MEMBER_MANAGE_PRIVILEGE',
                'pp_description' => 'Atur hak akses anggota/fotografer',
            ],
            [
                'pp_code' => 'ADMIN_MANAGE_VIEW',
                'pp_description' => 'Lihat daftar admin',
            ],
            [
                'pp_code' => 'ADMIN_MANAGE_SUSPEND',
                'pp_description' => 'Suspend atau aktifkan admin',
            ],
            [
                'pp_code' => 'ADMIN_MANAGE_PRIVILEGE',
                'pp_description' => 'Atur hak akses admin',
            ],
            [
                'pp_code' => 'ADMIN_MANAGE_ADD',
                'pp_description' => 'Tambah/hapus admin',
            ],
        ];

        DB::table('privilege')->insert($data);
    }
}
