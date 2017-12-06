<?php

namespace App\Console\Commands;

use Validator;
use RuntimeException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use App\User;

class InstallPortfolio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:portfolio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install portfolio with user admin.';

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
        $this->execShellWithPrettyPrint('php artisan key:generate');
        $this->execShellWithPrettyPrint('php artisan migrate');

        $data['name'] = $this->ask('What is your name');
        $data['email'] = $this->ask('What is your email!');
        $data['password'] = $this->ask('What is your password!');

        $validatedData = Validator::make($data, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|min:3|max:100|email|unique:users,email',
            'password' => 'required|min:3|max:100',
        ]);

        if (! $validatedData->passes()) {
            throw new RuntimeException($validatedData->errors()->first());
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'is_admin' => true,
        ]);

        $this->info('Portfolio has been instaled successfuly!');
    }


    /**
     * Exec sheel with pretty print.
     *
     * @param  string $command
     * @return mixed
     */
    public function execShellWithPrettyPrint($command)
    {
        $this->info('---');
        $this->info($command);
        $output = shell_exec($command);
        $this->info($output);
        $this->info('---');
    }
}
