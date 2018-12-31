<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\{User, Company};
use Validator;

class CreateAdminPerCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un nuevo administrador de una empresa.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->createAdmin();
    }

    private function createAdmin()
    {
        $data = [
            'name' => $this->ask('¿Cuál es el nombre del administrador?'),
            'email' =>  $this->ask('¿Cuál es el correo del administrador?'),
            'company_ruc' => $this->ask('¿Cuál es el RUC de la empresa de este administrador?')
        ];

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'company_ruc' => 'required|digits:11|exists:companies,ruc'
        ]);
        
        if ($validator->fails()) {
            return $this->error('¡Algo salió mal!. Inténtelo nuevamente.');
        }

        $this->info('Los datos para el administrador son los siguientes: ' . print_r($data, true));

        if ( $this->confirm('¿Deseas continuar con la creación del administrador?') ) {

            $company = Company::findByRuc($data['company_ruc']);

            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt( str_random(20) ),
                'company_id' => $company->id
            ]);
            
            return $this->info('El administrador ha sido creado con éxito.');
        }
    }
}
