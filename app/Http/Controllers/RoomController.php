<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Rental $rental, RoomType $roomtype)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Rental $rental, RoomType $roomtype)
    {
        $table = DB::table('rooms')->where('room_type_id', '=', $roomtype->id)->get('*');
        $number = 0;
        if (!$table->isEmpty()) {
            $max = count($table);

            for ($i=1; $i <= $max; $i++) { 
                print($i);
                if(!$table->contains('name', '=' ,$i)) {
                    $number = $i;
                    break;
                }
                else {
                    $number = $max + 1;
                }
            }

        } 
        else 
        {
            $number = 1;
        }

        $room = new Room;
        $room->name = $number;
        $room->rental_id = $rental->id;
        $room->room_type_id = $roomtype->id;
        $room->save();

        return redirect()->route('edit.roomtype', ['roomtype' => $roomtype, 'rental' => $rental]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental, RoomType $roomtype, Room $room)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }

        if (!$roomtype->id === $room->room_type_id) {
            abort(404);
        }

        if ($roomtype->rental_id === $rental->id)
            $room->delete();

        return redirect()->route('edit.roomtype', ['rental' => $rental, 'roomtype' => $roomtype]);
    }
}
