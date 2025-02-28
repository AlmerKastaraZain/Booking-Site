<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RoomImage;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RoomTypeUploadController
{
    public function store_room(Request $request, Rental $rental, RoomType $roomtype)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }

        $image = $request->file('file');
        $imageName = time() . ' ' . $image->getClientOriginalName();

        $roomImages = new RoomImage();
        $roomImages->room_id = $roomtype->id;
        $roomImages->rental_id = $rental->id;

        $roomImages->title = $image->getClientOriginalName();
        $roomImages->src = $imageName;
        $roomImages->save();

        Storage::disk('public')->putFileAs('room_images', $image, $imageName);
        return response()->json(['success'=> 'da']);
    }

    public function destroy_room(Request $request, Rental $rental, RoomType $roomtype, RoomImage $image)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }
        
        Storage::disk('public')->delete('room_images/' . $image->src );
        $image->delete();

        return redirect()->route('image.roomtype', ['rental' => $rental, 'roomtype' => $roomtype]);
    }
}
