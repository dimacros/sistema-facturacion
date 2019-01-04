<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Company;
use App\Events\CompanyCreated;
use Validator;

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
    private $messages = [
        'confirmation' => '¿Deseas continuar con la creación de la empresa?',
        'error' => '¡Algo salió mal!. Inténtelo nuevamente.',
        'success' => 'La empresa ha sido creada con éxito.'
    ];

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
        $validator = $this->validator($this->inputData());
        
        if ($validator->fails()) {
            return $this->error($this->messages['error']);
        }

        if ( $this->confirm($this->messages['confirmation']) ) {

            $data = $validator->validated();
            $company = $this->create($data);

            event(new CompanyCreated($company));

            return $this->info($this->messages['success']);

        }

    }

    protected function inputData()
    {
        return [
            'ruc' => $this->ask('¿Cuál es el RUC de la empresa?'),
            'name' =>  $this->ask('¿Cuál es el nombre de la empresa?'),
            'subdomain' => $this->ask('¿Cuál es el nombre del subdominio?')
        ];
    }

    protected function validator(array $data) 
    {
        return Validator::make($data, [
            'ruc' => 'required|numeric|digits:11',
            'name' => 'required',
            'subdomain' => 'required|string|max:12|unique:companies,subdomain'
        ]);
    }

    protected function create(array $data)
    {
        return Company::create([
            'ruc' => $data['name'],
            'name' => $data['name'],
            'subdomain' => $data['subdomain']
        ]);
    }
}
