<?php

namespace App\Console\Commands;

use App\User;
use Validator;
use RuntimeException;
use Illuminate\Console\Command;

class InstallAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install portfolio admin.';

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
            'password' => bcrypt($data['password']),
            'is_admin' => true,
        ]);

        $this->info('Admin has been created successfuly!');
    }
}
