<?php

namespace App\Listeners;

use App\Events\AccountCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class AccountCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AccountCreated  $event
     * @return void
     */
    public function handle(AccountCreated $event)
    {
    
        Mail::mail('emails.account-created',
            ['user' => $event->user], function ($m) use($event)  {
                $m->from('info@lmsexample.net', 'LMS');
                $m->to($event->user->email, $event->user->getFullName())
                  ->subject('Your LMS account is created.');
            });
    }
}
