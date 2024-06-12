<?php

namespace App\Console\Commands;

use App\Infra\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the first admin user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
        $name = $this->ask('Enter admin name');
        $lastname = $this->ask('Enter admin lastname');
        $email = $this->ask('Enter admin email');
        $password = $this->secret('Enter admin password');
        $role = 'admin'; // O papel do usuário é sempre 'admin' para o primeiro usuário
        $birth_date = Carbon::now()->subYears(18)->toDateString(); // Define a data de nascimento padrão como 18 anos atrás

        User::create([
            'uuid' => (string) Str::uuid(),
            'name' => $name,
            'lastname' => $lastname,
            'birth_date' => $birth_date,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
        ]);
        // Create the admin user

        $this->info('Admin user created successfully!');
    }
}
