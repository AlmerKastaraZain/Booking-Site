<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController
{
    public function success()
    {
        if (!Auth::user()->subscriptions) {
            return redirect('/');
        }

        $user = Auth::user();
        $user->type = "vendor";
        $user->save();



        return view('/success');
    }

    public function billing() {
        return view('vendors.transaction');
    }

    public function cancelSubscriptions() {
        if (!Auth::user()) {
            abort(404);
        };

        $user = Auth::user();

        $subscriptions = $user->subscriptions()->active()->get(); // getting all the active subscriptions 

        $subscriptions->map(function($subscription) {
            $subscription->cancel(); // cancelling each of the active subscription
        });

        $user->type = 'user';
        $user->save();

        return view('/home');
    }

    public function createStripeStore() {
        $store = Auth::user();

        // Param 1 - Account Type
        // Param 2 - Account Data
        $connectedAccount = $store->createAsStripeAccount('standard',);
    }
}
