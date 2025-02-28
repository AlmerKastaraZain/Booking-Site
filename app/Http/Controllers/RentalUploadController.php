<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RentalImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RentalUploadController
{
    //
    public function store_rental(Request $request, Rental $rental)
    {
        $image = $request->file('file');
        $imageName = time() . ' ' . $image->getClientOriginalName();

        $rentaImages = new RentalImage();
        $rentaImages->rental_id = $rental->id;

        $rentaImages->title = $image->getClientOriginalName();
        $rentaImages->src = $imageName;
        $rentaImages->save();

        Storage::disk('public')->putFileAs('rental_images', $image, $imageName);
        return response()->json(['success'=> $imageName]);
    }

    public function destroy_rental(Request $request, Rental $rental, RentalImage $image)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }
        
        Storage::disk('public')->delete('rental_images/' . $image->src );
        $image->delete();

        return redirect()->route('image.rental', ['rental' => $rental]);
    }
}
