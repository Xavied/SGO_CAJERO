<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Admin Usuario',
            'email' => 'admin@correo.com',
            'password' => bcrypt('123Nano_100')
        ]);
    }
}
