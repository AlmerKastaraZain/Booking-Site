<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Facilities;
use App\Models\FacilitiesFeature;
use App\Models\PropertyType;
use App\Models\Rental;
use App\Models\RentalImage;
use App\Models\Room;
use App\Models\RoomFacilities;
use App\Models\RoomFacilitiesFeature;
use App\Models\RoomImage;
use App\Models\RoomService;
use App\Models\RoomServicesFeature;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RentalController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vendors.listing');
    }

    public function guest()
    {
        return view('vendors.guest');
    }

    public function search(Request $request)
    {
        $request->validate([
            'location' => 'required',
            'checkin' => 'required|date',
            'checkout' => 'required|date',
            'adult' => 'required|integer',
            'children' => 'required|integer',
            'room' => 'required|integer',

            // Pet not implemented
        ]);


        if ($request->filled('min_price')) {
            $minPrice = $request->get('min_price');
        } 
        else 
        {
            $minPrice = RoomType::all()->min('price');
        }

        if ($request->filled('max_price')) {
            $maxPrice = $request->get('max_price');
        }
        else 
        {
            $maxPrice = RoomType::all()->max('price');
        }

        $rentals = Rental::with('RoomType')->where('status_id', '=', '3')
            ->whereHas('RoomType', function($q) use ($minPrice, $maxPrice) {
                $q->where('price', '>=' , $minPrice)->where('price', '<=' , $maxPrice);
            })
            ->whereHas('RoomType', function($q) use ($request) {
                $q->where('adult', '>=', $request->adult );
            })
            ->whereHas('RoomType', function($q) use ($request) {
                $q->where('child', '>=', $request->children );
            });


        $facilities = FacilitiesFeature::all();
        $services = RoomServicesFeature::all();
        $roomFacilities = RoomFacilitiesFeature::all();

        foreach ($facilities as $key => $value) {
            if ($request->filled($value->facility)) {
                $rentals = $rentals->whereHas('Facility', function($q) use ($value) {
                    $q->where('rental_facility', '=', $value->id);
                });
            }
        }

        foreach ($services as $key => $value) {
            if ($request->has($value->rental_service)) {
                $rentals = $rentals->whereHas('Service', function($q) use ($value) {
                    $q->where('service_id', '=', $value->id);
                });
            }
        }

        foreach ($roomFacilities as $key => $value) {
            if ($request->has($value->rental_facility)) {
                $rentals = $rentals->whereHas('RoomFacility', function($q) use ($value) {
                    $q->where('room_facility_id', '=', $value->id);
                });
            }
        }

        if ($request->filled('country')) {
            $rentals = $rentals->where('country', '=', $request->country);
        }

        if ($request->filled('administrative_area_level_1')) {
            $rentals = $rentals->where('administrative_area_level_1', '=', $request->administrative_area_level_1);
        }

        if ($request->filled('administrative_area_level_2')) {
            $rentals = $rentals->where('administrative_area_level_2', '=', $request->administrative_area_level_2);
        }
        if ($request->filled('administrative_area_level_3')) {
            $rentals = $rentals->where('administrative_area_level_3', '=', $request->administrative_area_level_3);
        }
        if ($request->filled('administrative_area_level_4')) {
            $rentals = $rentals->where('administrative_area_level_4', '=', $request->administrative_area_level_4);
        }
        if ($request->filled('administrative_area_level_5')) {
            $rentals = $rentals->where('administrative_area_level_5', '=', $request->administrative_area_level_5);
        }
        if ($request->filled('administrative_area_level_6')) {
            $rentals = $rentals->where('administrative_area_level_6', '=', $request->administrative_area_level_6);
        }
        if ($request->filled('administrative_area_level_7')) {
            $rentals = $rentals->where('administrative_area_level_7', '=', $request->administrative_area_level_7);
        }
        if ($request->filled('locality')) {
            $rentals = $rentals->where('locality', '=', $request->locality);
        }
        if ($request->filled('postal_code')) {
            $rentals = $rentals->where('postal_code', '=', $request->postal_code);
        }
        if ($request->filled('street_address')) {
            $rentals = $rentals->where('street_address', '=', $request->street_address);
        } 
        if ($request->filled('route')) {
            $rentals = $rentals->where('route', '=', $request->route);
        }
        $rentals = $rentals->get('*');
        $final_res = Rental::query();


        foreach ($rentals as $key => $rental) {
            foreach ($rental->RoomType() as $key => $roomType) {
                $count_res = Booking::Where('room_id', '=', $roomType->id)
                    ->whereBetween('check_in', [$request->checkin, $request->checkout])
                    ->whereBetween('check_out', [$request->checkin, $request->checkout])
                    ->count();

                if ($count_res > 0) {
                    $final_res = $final_res->where('id', '=', $rental->id );
                } 
            }
        }



        $rentals = $rentals->filter(function($item){
            $owner = User::find($item->TeamId->user_id);
            $result = false;
            if ($owner->subscriptions()->active()->count() > 0) {
                $result = true;
            }

            return $result;
        });

        if ( Count($rentals) === 0) {
            $rentals = $final_res->where('id', '=', '0')->with('PropertyTypeId')->paginate(54);
        } else {
            $rentals = $final_res->with('TeamId')->with('PropertyTypeId')->paginate(54);
        }

        $roomTypeHighestPrice = RoomType::max('price');

        return view('vendors.rental.search', compact([
            'rentals',
            'request',
            'facilities',
            'services',
            'roomFacilities',
            'roomTypeHighestPrice',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendors.rental.create');
    }


    public function image(Rental $rental)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }
        
        $images = DB::table('rental_images')->where('rental_id', '=', $rental->id)->get('*');
        return view('vendors.rental.manageimage', ['rental' => $rental, 'images' => $images]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:64|unique:rentals,name',
            'desc' => 'required',
            'property' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $rental = new Rental();
        $rental->name = $request->name;
        $rental->description = $request->desc;
        $rental->team_id = Auth::user()->currentTeam->id;

        $property_type = DB::table('property_types')->where('type', '=', $request->property)->firstOrFail();
        $rental->status_id = 2;

        $rental->property_type_id = $property_type->id;

        if ($request->filled('country')) {
            $rental->country = $request->country;
        }
        if ($request->filled('administrative_area_level_1')) {
            $rental->administrative_area_level_1 = $request->administrative_area_level_1;

        }
        if ($request->filled('administrative_area_level_2')) {
            $rental->administrative_area_level_2 = $request->administrative_area_level_2;

        }
        if ($request->filled('administrative_area_level_3')) {
            $rental->administrative_area_level_3 = $request->administrative_area_level_3;

        }
        if ($request->filled('administrative_area_level_4')) {
            $rental->administrative_area_level_4 = $request->administrative_area_level_4;

        }
        if ($request->filled('administrative_area_level_5')) {
            $rental->administrative_area_level_5 = $request->administrative_area_level_5;

        }
        if ($request->filled('administrative_area_level_6')) {
            $rental->administrative_area_level_6 = $request->administrative_area_level_6;

        }
        if ($request->filled('administrative_area_level_7')) {
            $rental->administrative_area_level_7 = $request->administrative_area_level_7;

        }
        if ($request->filled('locality')) {
            $rental->locality = $request->locality;

        }
        if ($request->filled('postal_code')) {
            $rental->postal_code = $request->postal_code;

        }
        if ($request->filled('street_address')) {
            $rental->street_address = $request->street_address;

        }        
        if ($request->filled('full_address')) {
            $rental->full_address = $request->full_address;
        }
        if ($request->filled('route')) {
            $rental->route = $request->route;

        }
        if ($request->filled('latitude')) {
            $rental->latitude = $request->latitude;

        }        
        if ($request->filled('longitude')) {
            $rental->longitude = $request->longitude;
        }
                                                
        $rental->save();
        $arrayAttribute = []; 
        if (isset($request->free_parking)) array_push($arrayAttribute, 'Free parking');
        if (isset($request->restaurant)) array_push($arrayAttribute, 'Restaurant');
        if (isset($request->pet_friendly)) array_push($arrayAttribute, 'Pet friendly');
        if (isset($request->hour)) array_push($arrayAttribute, '24-hour front desk');
        if (isset($request->fitness_center)) array_push($arrayAttribute, 'Fitness center');
        if (isset($request->non_smoking_rooms)) array_push($arrayAttribute, 'Non-smoking rooms');
        if (isset($request->airport_shuttle)) array_push($arrayAttribute, 'Airport shuttle');
        if (isset($request->family_rooms)) array_push($arrayAttribute, 'Family rooms');
        if (isset($request->spa)) array_push($arrayAttribute, 'Spa');
        if (isset($request->electric_vehicle)) array_push($arrayAttribute, 'Electric vehicle charging station');
        if (isset($request->wheelchair)) array_push($arrayAttribute, 'Wheelchair accessible');
        if (isset($request->swimming_pool)) array_push($arrayAttribute, 'Swimming pool');

        foreach ($arrayAttribute as $key) {
            $attribute = new Facilities;
            $attribute->rental_id = $rental->id;
            $attribute->rental_facility = 
                DB::table('facilities_features')->where('facility', '=', $key)->first()->id;
            $attribute->save();
        }

        return redirect()->route('listing');
    }

    /**
     * Display the specified resource.
     */
    public function calendar(Request $request) {
        $events = [];

        $bookings = Booking::with(['TeamId', 'UserId', 'RoomTypeId', 'RentalId'])->get();

        foreach ($bookings as $booking) {
            $events[] = [
                'title' => $booking->UserId->name . ' | ' . $booking->RoomTypeId->name . ' | ' . $booking->RentalId->name,
                'start' => $booking->check_in,
                'end' => $booking->check_out,
            ];
        }

        return view('vendors.rental.calendar', compact('events'));
    }   

    public function show(Request $request, Rental $rental)
    {
        
        $rentalImages = DB::table('rental_images')->where('rental_id', '=', $rental->id)->get();
        $roomTypes = RoomType::where('rental_id','=', $rental->id)->get('*');

        $roomTypesAmountAvailable = [];


        foreach($roomTypes as $key => $roomType) {
            $count_res = Booking::Where('room_id', '=', $roomType->id)
                ->whereBetween('check_in', [$request->checkin, $request->checkout])
                ->whereBetween('check_out', [$request->checkin, $request->checkout])
                ->count();
            
            array_push( $roomTypesAmountAvailable, array('room_id' => $roomType->id , 'amount' => (Room::where('room_type_id', '=', $roomType->id))->count() - $count_res) );
        }

        
        $roomImages =  RoomImage::where('rental_id','=', $rental->id)->get('*');

        $facilities = Facilities::query()->where('rental_id', '=', $rental->id)->with('RentalFacilityId')->get();
        $roomFacilities = RoomFacilities::query()->where('rental_id', '=', $rental->id)->with('RoomFacilityId')->get();
        $roomServices = RoomService::query()->where('rental_id', '=', $rental->id)->with('ServiceId')->get();
        
        $allowedView = false;
                


        if (Auth::check() && Auth::user()->type === 'admin') {
            $allowedView = true;
        }

        if (Auth::check() && Auth::user()->type === "vendor") {
            if ($rental->team_id === Auth::user()->currentTeam->id) {
                $allowedView = true;
            }
        }

        if ($rental->status_id === 3) {
            $allowedView = true;
        }

        $userOwner = User::where('id', '=', $rental->TeamId->user_id)->get('*')->first();

        if ($allowedView) {
            return view('vendors.rental.show', compact(
                'rental', 
                'rentalImages', 
                'roomTypes', 
                'facilities', 
                'roomImages', 
                'roomFacilities', 
                'roomServices',
                'request',
                'roomTypesAmountAvailable',
                'userOwner'
            ));
        }

        abort(404);
    }

    public function resubmit(Rental $rental)
    {
        $rental->status_id = '2';

        return redirect()->route('listing');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }
        $facilities = Facilities::all()->where('rental_id', '=', $rental->id);
        $facilite = [];
        foreach ($facilities as $facility) {
            array_push($facilite , $facility->rental_facility);
        }

        $type = PropertyType::query()->where('id', '=', $rental->property_type_id)->first();
        return view('vendors.rental.edit', ['rental'=>$rental, 'type' => $type->type, 'facilities'=>$facilite]);

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }
        $request->validate([
            'name' => 'required|max:64',
            'desc' => 'required',
            'property' => 'required'
        ]);

        $rental->name = $request->name;
        $rental->description = $request->desc;
        $rental->team_id = Auth::user()->currentTeam->id;
        $property_type = DB::table('property_types')->where('type', '=', $request->property)->firstOrFail();
        $rental->property_type_id = $property_type->id;

        if ($request->filled('country')) {
            $rental->country = $request->country;
        }
        if ($request->filled('administrative_area_level_1')) {
            $rental->administrative_area_level_1 = $request->administrative_area_level_1;

        }
        if ($request->filled('administrative_area_level_2')) {
            $rental->administrative_area_level_2 = $request->administrative_area_level_2;

        }
        if ($request->filled('administrative_area_level_3')) {
            $rental->administrative_area_level_3 = $request->administrative_area_level_3;

        }
        if ($request->filled('administrative_area_level_4')) {
            $rental->administrative_area_level_4 = $request->administrative_area_level_4;

        }
        if ($request->filled('administrative_area_level_5')) {
            $rental->administrative_area_level_5 = $request->administrative_area_level_5;

        }
        if ($request->filled('administrative_area_level_6')) {
            $rental->administrative_area_level_6 = $request->administrative_area_level_6;

        }
        if ($request->filled('administrative_area_level_7')) {
            $rental->administrative_area_level_7 = $request->administrative_area_level_7;

        }
        if ($request->filled('locality')) {
            $rental->locality = $request->locality;

        }
        if ($request->filled('postal_code')) {
            $rental->postal_code = $request->postal_code;

        }
        if ($request->filled('street_address')) {
            $rental->street_address = $request->street_address;

        }        
        if ($request->filled('full_address')) {
            $rental->full_address = $request->full_address;
        }
        if ($request->filled('route')) {
            $rental->route = $request->route;

        }
        if ($request->filled('latitude')) {
            $rental->latitude = $request->latitude;

        }        
        if ($request->filled('longitude')) {
            $rental->longitude = $request->longitude;
        }
        $rental->update();

        $facilities = Facilities::all()->where('rental_id', '=', $rental->id);
        foreach ($facilities as $facility) {
            $facility->delete();
        }

        $arrayAttribute = []; 
        if (isset($request->free_parking)) array_push($arrayAttribute, 'Free parking');
        if (isset($request->restaurant)) array_push($arrayAttribute, 'Restaurant');
        if (isset($request->pet_friendly)) array_push($arrayAttribute, 'Pet friendly');
        if (isset($request->hour)) array_push($arrayAttribute, '24-hour front desk');
        if (isset($request->fitness_center)) array_push($arrayAttribute, 'Fitness center');
        if (isset($request->non_smoking_rooms)) array_push($arrayAttribute, 'Non-smoking rooms');
        if (isset($request->airport_shuttle)) array_push($arrayAttribute, 'Airport shuttle');
        if (isset($request->family_rooms)) array_push($arrayAttribute, 'Family rooms');
        if (isset($request->spa)) array_push($arrayAttribute, 'Spa');
        if (isset($request->electric_vehicle)) array_push($arrayAttribute, 'Electric vehicle charging station');
        if (isset($request->wheelchair)) array_push($arrayAttribute, 'Wheelchair accessible');
        if (isset($request->swimming_pool)) array_push($arrayAttribute, 'Swimming pool');

        foreach ($arrayAttribute as $key) {
            $attribute = new Facilities;
            $attribute->rental_id = $rental->id;
            $attribute->rental_facility = 
                DB::table('facilities_features')->where('facility', '=', $key)->first()->id;
            $attribute->save();
        }

        return redirect()->route('edit.rental', ['rental' => $rental]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id || Auth::user()->type === 'admin') {
            abort(404);
        }

        $roomTypes = RoomType::where('rental_id', '=', $rental->id)->get();
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        foreach ($roomTypes as $roomtype) {
            
            $product = $stripe->products->search([
                'query' => 'name:\'' . $roomtype->name .  '\' AND metadata[\'roomtype_id\']:\' ' . $roomtype->id . '\'',
            ]);
                
            if (count( $product->data ) !== 0) {
                $product_id = $product->data[0]->id;
                $stripe->products->delete($product_id);
            }
        }

          
        if ($rental->team_id === Auth::user()->currentTeam->id)
            $rental->delete();

        return redirect('/dashboard/listing');
    }
}
