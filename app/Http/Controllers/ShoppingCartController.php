<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RoomType;
use App\Models\ShoppingCartTypeBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController
{
    public function store(Request $request, Rental $rental, int $roomType, string $checkin, string $checkout) {
        $request->validate([
            'roomAmount' => 'required'
        ]);

        if(Auth::user()->type === 'vendor' || Auth::user()->type == 'admin') {
            return redirect()->back()->with('vendorAndAdmin', 'Item has been added to shopping cart!');
        }

        if (($checkin === "-" || $checkin === "") || ($checkout === "-" || $checkout === "")) {
            return redirect()->back();
        }
        
        $booking = new ShoppingCartTypeBooking;
        $booking->rental_id = $rental->id;
        $booking->room_type_id = $roomType;
        try {
            $booking->amount = (int) $request->roomAmount;
        } catch (\Throwable $th) {
            abort(404);
        }
        $booking->user_id = Auth::user()->id;
        $booking->check_in = $checkin;
        $booking->check_out = $checkout;

        $booking->save();

        return redirect()->back()->with('addedToShoppingCart', 'Item has been added to shopping cart!');
    }

    public function destroy(ShoppingCartTypeBooking $booking) {
        $booking->deleteOrFail();

        return redirect()->back(); 
    }
}
