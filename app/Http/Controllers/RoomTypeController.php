<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RoomFacilities;
use App\Models\RoomService;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomTypeController
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
    public function create(Rental $rental)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }

        return view('vendors.roomtype.create', ['rental' => $rental]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Rental $rental)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }



        $request->validate([
            'name' => 'required|max:64',
            'desc' => 'required',
            'size' => 'required|numeric',
            'price' => 'required|numeric',
            'bed' => 'required|numeric',
            'adult' => 'required|numeric',
            'children' => 'required|numeric',
        ]);



        $roomType = new RoomType();
        $roomType->name = $request->name;
        $roomType->description = $request->desc;
        $roomType->price = $request->price;
        $roomType->rental_id = $rental->id;
        $roomType->wide = $request->size;
        $roomType->can_smoke = (isset($request->can_smoke)) ? 1 : 0;
        $roomType->adult = $request->adult;
        $roomType->child = $request->children;
        $roomType->bed = $request->bed;
        $roomType->save();


        if ($request->wifi)
        {
            $service = new RoomService;
            $service->rental_id = $rental->id;
            $service->room_type_id = $roomType->id;
            $service->service_id = 
                DB::table('room_services_features')->where('rental_service', '=', 'Wifi')->first()->id;
            $service->cost = ($request->wifi_cost === "") ? $request->wifi_cost : "0";
            $service->save();
        };
        if ($request->breakfast)
        {
            $service = new RoomService;
            $service->rental_id = $rental->id;
            $service->room_type_id = $roomType->id;
            $service->service_id = 
                DB::table('room_services_features')->where('rental_service', '=', 'Breakfast')->first()->id;
            $service->cost = ($request->breakfast_cost === "") ? $request->breakfast_cost : "0";
            $service->save();
        };
        if ($request->service)
        {
            $service = new RoomService;
            $service->rental_id = $rental->id;
            $service->room_type_id = $roomType->id;
            $service->service_id = 
                DB::table('room_services_features')->where('rental_service', '=', 'Room service')->first()->id;
            $service->cost = ($request->service_cost === "") ? $request->service_cost : "0";
            $service->save();
        };

        $arrayAttribute = []; 
        if (isset($request->kitchen)) array_push($arrayAttribute, 'Kitchen');
        if (isset($request->air_conditioning)) array_push($arrayAttribute, 'Air conditioning');
        if (isset($request->private_pool)) array_push($arrayAttribute, 'Private pool');
        if (isset($request->balcony)) array_push($arrayAttribute, 'Balcony');
        if (isset($request->washing_machine)) array_push($arrayAttribute, 'Washing machine');
        if (isset($request->view)) array_push($arrayAttribute, 'View');
        if (isset($request->bathtub)) array_push($arrayAttribute, 'Bathtub ');
        if (isset($request->hottub)) array_push($arrayAttribute, 'Hottub');
        if (isset($request->heating)) array_push($arrayAttribute, 'Heating');
        if (isset($request->refrigerator)) array_push($arrayAttribute, 'Refrigerator');
        if (isset($request->tv)) array_push($arrayAttribute, 'TV');
        if (isset($request->shower)) array_push($arrayAttribute, 'Shower');
        if (isset($request->toilet_paper)) array_push($arrayAttribute, 'Toilet paper');
        if (isset($request->hair_dryer)) array_push($arrayAttribute, 'Hair dryer');
        if (isset($request->coffee_maker)) array_push($arrayAttribute, 'Coffee Maker');
        if (isset($request->toaster)) array_push($arrayAttribute, 'Toaster');
        if (isset($request->sofa)) array_push($arrayAttribute, 'Sofa');
        if (isset($request->toilet)) array_push($arrayAttribute, 'Toilet');


        foreach ($arrayAttribute as $key) {
            $attribute = new RoomFacilities;
            $attribute->rental_id = $rental->id;
            $attribute->room_type_id = $roomType->id;
            $attribute->room_facility_id = 
                DB::table('room_facilities_features')->where('rental_facility', '=', $key)->first()->id;
            $attribute->save();
        }

        $product = $request->user()->createConnectedProduct([
            'name' => $roomType->name,
            'metadata' => ['roomtype_id' => $roomType->id]
        ]);

        $request->user()->createPriceForConnectedProduct($product, [
            'unit_amount' => $roomType->price  * 100,
            'currency' => 'usd',
        ]);

        return redirect()->route('edit.rental', ['rental' => $rental]);
    }

    public function image(Rental $rental, RoomType $roomtype)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }
        
        $images = DB::table('room_images')->where('room_id', '=', $roomtype->id)->get('*');
        return view('vendors.roomtype.manageimage', ['rental' => $rental, 'roomtype' => $roomtype,'images' => $images]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental, RoomType $roomType)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental, RoomType $roomtype)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }
        $attribute = DB::table('room_services')->where('rental_id', '=', $rental->id)->get('*');
        
        $attribute_facility_id = [];
        $attribute2 = DB::table('room_facilities')->where('rental_id', '=', $rental->id)->get('room_facility_id');
        foreach ($attribute2 as $key) {
            array_push($attribute_facility_id, $key->room_facility_id);
        }

        return view('vendors.roomtype.edit', [
            'rental' =>  $rental, 
            'roomtype' => $roomtype, 
            'facilities' => $attribute_facility_id,
            'service' => $attribute
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental, RoomType $roomtype)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }
        
        $request->validate([
            'name' => 'required|max:64',
            'desc' => 'required',
        ]);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $product = $stripe->products->search([
            'query' => 'name:\'' . $roomtype->name .  '\' AND metadata[\'roomtype_id\']:\' ' . $roomtype->id . '\'',
        ]);

        if ( $product->data[0]['name'] != $request->get('name') ) {
            $product_id = $product->data[0]->id;
            $stripe->products->delete($product_id);

            $product = $request->user()->createConnectedProduct([
                'name' => $request->name,
                'metadata' => ['roomtype_id' => $roomtype->id]
            ]);
    
            $request->user()->createPriceForConnectedProduct($product, [
                'unit_amount' => $request->get('price')  * 100,
                'currency' => 'usd',
            ]);
    
        }
        else if (count( $product->data ) !== 0) {
            $product_id = $product->data[0]->id;
            $request->user()->editConnectedProduct($product_id, [
                'name' => $request->get('name')
            ]);

            $request->user()->editConnectedPrice($product_id, [
                'unit_amount' => $request->get('price') * 100,
            ]);
        } 
        else 
        {

            $product = $request->user()->createConnectedProduct([
                'name' => $request->name,
                'metadata' => ['roomtype_id' => $roomtype->id]
            ]);
    
            $request->user()->createPriceForConnectedProduct($product, [
                'unit_amount' => $request->get('price')  * 100,
                'currency' => 'usd',
            ]);
    
        }

        $roomtype->name = $request->name;
        $roomtype->description = $request->desc;
        $roomtype->price = $request->price;
        $roomtype->rental_id = $rental->id;
        $roomtype->wide = $request->size;
        $roomtype->can_smoke = (isset($request->can_smoke)) ? 1 : 0;
        $roomtype->adult = $request->adult;
        $roomtype->child = $request->children;
        $roomtype->bed = $request->bed;
        $roomtype->update();


        if (count( $product->data ) === 0) {
            $product = $request->user()->createConnectedProduct([
                'name' => $roomtype->name,
                'metadata' => ['roomtype_id' => $roomtype->id]
            ]);
    
            $request->user()->createPriceForConnectedProduct($product, [
                'unit_amount' => $roomtype->price  * 100,
                'currency' => 'usd',
            ]);
        }

        $m = RoomService::query()->where('rental_id', '=', $rental->id)->where('room_type_id', '=', $roomtype->id)->get('*');
        
        foreach ($m as $ms) {
            $ms->deleteOrFail();
        }


        if ($request->wifi)
        {

            $service = new RoomService;
            $service->rental_id = $rental->id;
            $service->room_type_id = $roomtype->id;
            $service->service_id = 
                DB::table('room_services_features')->where('rental_service', '=', 'Wifi')->first()->id;
            $service->cost = ($request->wifi_cost !== "0" || $request->wifi_cost === "") ? $request->wifi_cost : "0";
            $service->save();
        };


        if ($request->breakfast)
        {
            $service = new RoomService;
            $service->rental_id = $rental->id;
            $service->room_type_id = $roomtype->id;
            $service->service_id = 
                DB::table('room_services_features')->where('rental_service', '=', 'Breakfast')->first()->id;
            $service->cost = ($request->breakfast_cost === "") ? $request->breakfast_cost : "0";
            $service->save();
        };

        if ($request->service) 
        {
            $service = new RoomService;
            $service->rental_id = $rental->id;
            $service->room_type_id = $roomtype->id;
            $service->service_id = 
                DB::table('room_services_features')->where('rental_service', '=', 'Room service')->first()->id;
            $service->cost = ($request->service_cost === "") ? $request->service_cost : "0";
            $service->save();
        };

        $facilities = RoomFacilities::all()->where('room_type_id', '=', $roomtype->id);
        foreach ($facilities as $facility) {
            $facility->delete();
        }

        $arrayAttribute = []; 
        if (isset($request->kitchen)) array_push($arrayAttribute, 'Kitchen');
        if (isset($request->air_conditioning)) array_push($arrayAttribute, 'Air conditioning');
        if (isset($request->private_pool)) array_push($arrayAttribute, 'Private pool');
        if (isset($request->balcony)) array_push($arrayAttribute, 'Balcony');
        if (isset($request->washing_machine)) array_push($arrayAttribute, 'Washing machine');
        if (isset($request->view)) array_push($arrayAttribute, 'View');
        if (isset($request->bathtub)) array_push($arrayAttribute, 'Bathtub ');
        if (isset($request->hottub)) array_push($arrayAttribute, 'Hottub');
        if (isset($request->heating)) array_push($arrayAttribute, 'Heating');
        if (isset($request->refrigerator)) array_push($arrayAttribute, 'Refrigerator');
        if (isset($request->tv)) array_push($arrayAttribute, 'TV');
        if (isset($request->shower)) array_push($arrayAttribute, 'Shower');
        if (isset($request->toilet_paper)) array_push($arrayAttribute, 'Toilet paper');
        if (isset($request->hair_dryer)) array_push($arrayAttribute, 'Hair dryer');
        if (isset($request->coffee_maker)) array_push($arrayAttribute, 'Coffee Maker');
        if (isset($request->toaster)) array_push($arrayAttribute, 'Toaster');
        if (isset($request->sofa)) array_push($arrayAttribute, 'Sofa');
        if (isset($request->toilet)) array_push($arrayAttribute, 'Toilet');


        foreach ($arrayAttribute as $key) {
            $attribute = new RoomFacilities;
            $attribute->rental_id = $rental->id;
            $attribute->room_type_id = $roomtype->id;
            $attribute->room_facility_id = 
                DB::table('room_facilities_features')->where('rental_facility', '=', $key)->first()->id;
            $attribute->save();
        }


        return redirect()->route('edit.roomtype', ['roomtype' => $roomtype, 'rental' => $rental]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental, RoomType $roomtype)
    {
        if (Auth::user()->currentTeam->id !== $rental->team_id) {
            abort(404);
        }

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $product = $stripe->products->search([
            'query' => 'name:\'' . $roomtype->name .  '\' AND metadata[\'roomtype_id\']:\' ' . $roomtype->id . '\'',
        ]);


        if (count( $product->data ) !== 0) {
            $product_id = $product->data[0]->id;
            $stripe->products->delete($product_id);
        }

        if ($roomtype->rental_id === $rental->id)
            $roomtype->delete();

        return redirect()->route('edit.rental', ['rental' => $rental]);
    }
}
