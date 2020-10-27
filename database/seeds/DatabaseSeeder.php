<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::create([
            'name'  => 'admin',
            'email' => 'admin@app.com',
            'password'=> bcrypt('123456')
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
