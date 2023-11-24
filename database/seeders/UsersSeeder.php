<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'    => (string) Str::uuid(),
                'role_id'	=> '7077c67a-82e6-4812-9625-23906bc34c5f',
                'name'	=> 'Admin',
                'username'	=> 'admin',
                'password'	=> '123456',
            ]
        ];

        DB::table('users')->insert($data);
    }
}
