<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\Email;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'test:send-mail'; // khong truyen tham so
    protected $signature = 'test:send-mail {userId}'; //co tham so truyen vao
    // protected $signature = 'test:send-mail {id?} {name?} {age?}'; //tham so truyen vao tuy chon

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $user = User::find($this->argument('userId')); //tim user co id la tham so truyen vao
        Mail::to($user)->send(new Email($user)); //gui mail cho user do bang class Email
    }
}
