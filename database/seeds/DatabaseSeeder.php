<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $seeders = [
        CompaniesTableSeeder::class,
        UsersTableSeeder::class,
        UnitsTableSeeder::class
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->seeders);
    }
}
