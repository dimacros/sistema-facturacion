<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'ruc' => '10762119221',
            'name' => 'Dimacros',
            'subdomain' => 'example'
        ]);
    }
}
