<?php

use Illuminate\Database\Seeder;
use src\Users\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create();
        factory(User::class)->create(['emailAddress' => 'admin@domain.com']);
    }
}
