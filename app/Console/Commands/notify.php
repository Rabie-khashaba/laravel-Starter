<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\NotifyEmail;


class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail to Users';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
        $emails = User::pluck('email')->toArray();

        $data=['title'=> 'progrmming' , 'body' => 'php'];

        foreach($emails as $email){
            Mail::To($email)-> send(new NotifyEmail($data));
        }
    }
}
