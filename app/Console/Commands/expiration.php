<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
        $users = User::where('expire', 0)->get();

        foreach($users as $user){
            $user ->update(['expire' => 1 ]);
        }
    }
}
