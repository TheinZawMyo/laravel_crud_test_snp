<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            array(
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'type' => 'admin',
            )
            );
    }
}
