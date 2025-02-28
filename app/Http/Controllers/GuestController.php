<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ShoppingCartTypeBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController
{
    //
    public function dashboard() {
        return view('guest.dashboard');
    }

    public function purchases() {
        return view('guest.purchases');
    }
    public function shoppingcart() {
        $bookings = ShoppingCartTypeBooking::where('user_id', '=', Auth::user()->id)->with('RentalId')->with('RoomTypeId')->get('*');

        return view('guest.shoppingcart', compact(
            'bookings'
        ));
    }

    public function checkoutForm() {
        $bookings = ShoppingCartTypeBooking::where('user_id', '=', Auth::user()->id)->with('RentalId')->with('RoomTypeId')->get('*');

        return view('guest.shoppingcart-form',compact(
            'bookings'
        ));
    }

    public function bookings() {
        $events = [];

        $bookings = Booking::with(['TeamId', 'UserId', 'RoomTypeId', 'RentalId'])->where('user_id', '=', Auth::user()->id)->get();

        dd(Auth::user()->id);
        foreach ($bookings as $booking) {
            $events[] = [
                'title' => $booking->UserId->name . ' | ' . $booking->RoomTypeId->name . ' | ' . $booking->RentalId->name,
                'start' => $booking->check_in,
                'end' => $booking->check_out,
            ];
        }

        return view('guest.bookings', compact('events'));
    }


    public function notification() {
        return view('guest.shoppingcart');
    }
}
