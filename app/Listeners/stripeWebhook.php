<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Events\WebhookReceived;
 
class stripeWebhook
{
    /**
     * Handle received Stripe webhooks.
     */
    public function handle(WebhookReceived $event): void
    {

        if ($event->payload['type'] === 'customer.subscription.deleted'
        || $event->payload['type'] === 'subscription_schedule.aborted'
        || $event->payload['type'] === 'subscription_schedule.canceled'
        || $event->payload['type'] === 'subscription_schedule.canceled'
        ) {
           Auth::user()->type = 'user';
       }

       if ($event->payload['type'] === 'subscription_schedule.created'
        || $event->payload['type'] === 'customer.subscription.updated'
        || $event->payload['type'] === 'subscription_schedule.canceled'
        || $event->payload['type'] === 'subscription_schedule.canceled'
        ) {
           Auth::user()->type = 'user';
       };
    }
}