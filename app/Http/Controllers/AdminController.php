<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController
{
    public function dashboard() {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $balance = $stripe->balance->retrieve([]);
        $values = ['available', 'pending'];
        $currency = config('nova.currency');

        $currentBalance = [
            $balance["available"][0]["amount"] / 100,
            $balance["available"][0]["currency"],
        ];
        $pending = [
            $balance["pending"][0]["amount"] / 100,
            $balance["pending"][0]["currency"],
        ];

        return view('admin.admin-dashboard', compact('currentBalance', 'pending'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
        ]);

        $user = new User();
        $user->name = $request->username;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->type = 'admin';
        $user->saveOrFail();


        return redirect()->route('admin.manageadmin');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.manageadmin');
    }

    public function approve(Rental $rental)
    {
        $rental->status_id = '3';
        $rental->saveOrFail();

        return redirect()->route('admin.manageproperty');
    }

    public function disapprove(Rental $rental)
    {
        $rental->status_id = '1';
        $rental->saveOrFail();

        return redirect()->route('admin.manageproperty');
    }
}

