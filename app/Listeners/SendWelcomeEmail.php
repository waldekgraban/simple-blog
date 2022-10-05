<?php
 
namespace App\Listeners;
 
use App\Events\UserRegistered;
use App\Jobs\SendRegistrationEmailJob;
 
class SendWelcomeEmail
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $details['email'] = $event->user->email;
        
        dispatch(new SendRegistrationEmailJob($details));
    }
}