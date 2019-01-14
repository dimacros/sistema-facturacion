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
    private $messages = [
        'confirmation' => '¿Deseas continuar con la creación del administrador?',
        'error' => '¡Algo salió mal!. Inténtelo nuevamente.',
        'success' => 'El administrador ha sido creado con éxito.'
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
        $this->createAdmin();
    }

    protected function createAdmin()
    {
        $input = $this->inputData();
        $validator = $this->validator($input);
        
        if ($validator->fails()) {
            return $this->error($this->messages['error']);
        }

        if ( $this->confirm($this->messages['confirmation']) ) {

            $company = Company::findByRuc($input['company_ruc']);
            $data = array_merge( $validator->validated(), [
                'company_id' => $company->id
            ]);
            $user = $this->create($data);
            $user->assignRole('admin');

            return $this->info($this->messages['success']);
        }
    }

    protected function inputData()
    {
        return [
            'first_name' => $this->ask('¿Cuál es el nombre del administrador?'),
            'last_name' => $this->ask('¿Cuáles son los apellidos del administrador?'),
            'email' =>  $this->ask('¿Cuál es el correo del administrador?'),
            'company_ruc' => $this->ask('¿Cuál es el RUC de la empresa?')
        ];
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'company_ruc' => 'required|digits:11|exists:companies,ruc'
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt( str_random(20) ),
            'company_id' => $data['company_id']
        ]);
    }
}
