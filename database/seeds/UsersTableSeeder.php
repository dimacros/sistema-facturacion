<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdmin();
    }

    private function createAdmin() 
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@dimacros.net',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'remember_token' => NULL,
            'company_id' => 1
        ]);
    }
}
