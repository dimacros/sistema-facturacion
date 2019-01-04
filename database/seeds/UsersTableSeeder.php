<?php

use Illuminate\Database\Seeder;
use App\{Company, User};
use Spatie\Permission\Models\Role;

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
        $company = Company::create([
            'ruc' => '10762119221',
            'name' => 'Dimacros',
            'subdomain' => 'dimacros'
        ]);
        
        $role = Role::create([
            'name' => 'admin', 
            'title' => 'Administrador'
        ]);

        $user = User::create([
            'first_name' => 'Administrator',
            'last_name' => 'Dimacros',
            'email' => 'admin@dimacros.net',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'),
            'company_id' => $company->id
        ]);

        $user->assignRole('admin');
    }
}
