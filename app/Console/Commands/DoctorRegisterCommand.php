<?php

namespace App\Console\Commands;

use App\Model\Doctor;
use App\Model\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DoctorRegisterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doctor:register {name} {surname} {email} {password} {specialization}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating a new Doctor User';

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
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $user = new User();
            $user->name =$input->getArgument('name');
            $user->email = $input->getArgument('email');
            $password = $input->getArgument('password');
            $user->password = Hash::make($password);
            $user->role = 'doctor';
            $user->save();
            $doctor = new Doctor();
            $doctor->name = $input->getArgument('name');
            $doctor->surname = $input->getArgument('surname');
            $doctor->specialization = $input->getArgument('specialization');
            $user = User::where('email', $input->getArgument('email'))->first();
            $doctor->u_id = $user->id;
            $doctor->save();
            $this->info('Success');
            return 0;
        } catch (CommandNotFoundException $exception)
        {
            $this->info('Failed...');
            return 0;
        }


    }
}
