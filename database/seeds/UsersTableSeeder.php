<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
          'name' => 'Admin',
          'email' => 'admin@gmail.com',
          'password' => bcrypt('123456'),
          'role' => 1
        ];

        \App\User::create($admin);
    }
}
