<?php

namespace App\Console\Commands;

use App\Models\EmailMessage;
use App\Models\User;
use App\Notifications\SendEmailMessageNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;

class QueueEmailMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:mails {--user= : The id of the user whose email messages are going to be sent}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queues the pending email messages';

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
        // get email messages
        $emailMessages = $this->getEmailMessages();

        // queue email messages
        foreach ($emailMessages as $emailMessage) {
            $emailMessage->update(['queued_at' => now()]);

            Notification::route('mail', $emailMessage->to)->notify(
                new SendEmailMessageNotification($emailMessage)
            );
        }
    }

    /**
     * Returns unsent email messages wheater by user or all of them.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getEmailMessages(): Collection
    {
        // get email messages by user if the option was passed
        if (! is_null($userId = $this->option('user'))) {
            return $this->getUserById($userId)->emailMessages()->notSent()->get();
        }

        // get all email messages
        return EmailMessage::notSent()->get();
    }

    /**
     * Returns the user model.
     *
     * @param  string  $userId
     * @return \App\Models\User
     */
    private function getUserById(string $userId): User
    {
        return User::findOrFail($userId);
    }
}
