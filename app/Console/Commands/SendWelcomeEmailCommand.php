<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\SendWelcomeEmailJob;

class SendWelcomeEmailCommand extends Command
{
    protected $signature = 'email:send-welcome {userId}';
    protected $description = 'Dispatch welcome email job manually for testing';

    public function handle()
    {
        $userId = $this->argument('userId');
        $user = User::find($userId);

        if (!$user) {
            $this->error('User not found!');
            return 1;
        }

        SendWelcomeEmailJob::dispatch($user);
        $this->info("Welcome email job dispatched for user: {$user->email}");
    }
}
