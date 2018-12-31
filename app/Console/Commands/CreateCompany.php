<?php

namespace App\Console\Commands;
use App\Company;
use Validator;
use Illuminate\Console\Command;

class CreateCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear una nueva empresa en la aplicación.';

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
        $this->createCompany();
    }

    private function createCompany() 
    {
        $data = [
            'ruc' => $this->ask('¿Cuál es el RUC de la empresa?'),
            'name' =>  $this->ask('¿Cuál es el nombre de la empresa?'),
            'subdomain' => $this->ask('¿Cuál es el nombre del subdominio?')
        ];
        
        $validator = Validator::make($data, [
            'ruc' => 'required|digits:11',
            'name' => 'required',
            'subdomain' => 'required|unique:companies,subdomain'
        ]);
        
        if ($validator->fails()) {
            return $this->error('¡Algo salió mal!. Inténtelo nuevamente.');
        }

        $this->info('Los datos para la empresa son los siguientes: ' . print_r($data, true));

        if ( $this->confirm('¿Deseas continuar con la creación de la empresa?') ) {
            Company::create($data);
            return $this->info('La empresa ha sido creada con éxito.');
        }

    }
}
