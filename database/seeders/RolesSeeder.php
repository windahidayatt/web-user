<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
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
                'id'    => '7077c67a-82e6-4812-9625-23906bc34c5f',
                'name'	=> 'Admin',
                'desc'	=> 'Admin can access all menu and abilities.',
            ],
            [
                'id'    => (string) Str::uuid(),
                'name'	=> 'Participant',
                'desc'	=> 'Participant only can see which team they were included',
            ]
        ];

        DB::table('roles')->insert($data);
    }
}
