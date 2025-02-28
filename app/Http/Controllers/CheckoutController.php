<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Customer;
use App\Models\CustomerPurchase;
use App\Models\CustomerPurchaseDetail;
use App\Models\Rental;
use App\Models\Room;
use App\Models\RoomService;
use App\Models\RoomType;
use App\Models\ShoppingCartTypeBooking;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Exception;
use Google\Service\AndroidPublisher\Resource\Purchases;
use Google\Service\HangoutsChat\Resource\Rooms;
use Google\Service\Walletobjects\PurchaseDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;
use Stripe\StripeClient;

class CheckoutController
{
    /**
     * Handle the incoming request.
     */
    public function purchaseSubscriptionOne(Request $request, string $plan = "price_1QdtKKJQ4w1zBP0WuESfzdYk")
    {
        switch ($plan) {
            case env('STRIPE_MEMBERSHIP_PRICE_ONE'):
                $user = Auth::user();
                $user->save();

                return $request->user()
                ->newSubscription(env('STRIPE_MEMBERSHIP_PRODUCT_ONE'), $plan)
                ->trialDays(180)
                ->checkout([
                    'success_url' => route('success'),
                    'cancel_url' => route('/'),
                ]);
                break;
            default:
                abort(402);
                break;
        }
    }

    public function shoppingcartForm(Request $request,  Rental $rental, string $url, string $checkin, string $checkout) {

        $purchase = RoomType::where('rental_id', '=', $rental->id)->get();

        
        try {
            $checkin_check = Carbon::parse($checkin);
            $checkout_check = Carbon::parse($checkout);
        } catch (InvalidFormatException $e) {
            return redirect('/listing/ ' . $rental->id . '/show' .  "?" . $url)->with('DateError', 'DateError');
        }

        if ($checkin_check < Carbon::now()->yesterday() || $checkout_check < Carbon::now()->yesterday()) {
            return redirect('/listing/ ' . $rental->id . '/show' .  "?" . $url)->with('DateError', 'DateError');
        };


        if (Auth::user() && (Auth::user()->type === 'admin' || Auth::user()->type === 'vendor')) {
            return redirect('/listing/ ' . $rental->id . '/show' .  "?" . $url)->with('vendorAndAdmin', 'vendorAndAdmin');
        }

        if ($checkin == 'undefined' || $checkout == 'undefined' || $checkin == '' || $checkout == '') {
            return redirect('/listing/ ' . $rental->id . '/show' .  "?" . $url)->with('DateError', 'DateError');
        }

        $res = [];
        foreach ($purchase as $key) {
            array_push($res, array(
                "id" => $key->id,
                "name" => $key->name,
                "amount" =>  $request->filled(str_replace(' ', '', $key->name).'RoomAmount') ? $request->get(str_replace(' ', '', $key->name).'RoomAmount') : 0,
                "price" => $key->price,
            ));
        }


        if ($key["amount"] !== "0" ) {
            return view('guest.rental-form', compact('res', 'rental', 'url', 'checkin', 'checkout') );
        };

        return redirect('/listing/ ' . $rental->id . '/show' .  "?" . $url)->with('Overboard', 'Overboard');
    }

    public function shoppingcartCheckout(Request $request, Rental $rental, string $url, string $checkin, string $checkout) {


        // Parse the query string
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'message' => 'required',
        ]);


        if (Auth::user() && (Auth::user()->type === 'admin' || Auth::user()->type === 'vendor')) {
            return redirect('/listing/ ' . $rental->id . '/show' . '?')->with( 'vendorAndAdmin', 'vendorAndAdmin');
        }

        $purchase = RoomType::where('rental_id', '=', $rental->id)->get();


        $res = [];
        foreach ($purchase as $key) {
            array_push($res, array(
                "id" => $key->id,
                "name" => $key->name,
                "amount" => $request->filled(str_replace(' ', '', $key->name).'RoomAmount') ? $request->get(str_replace(' ', '', $key->name).'RoomAmount') : 0,
                "price" => $key->price,
            ));
        };

        
        foreach ($res as $key => $value) {
            $count_res = Booking::Where('room_id', '=', $value['id'])
                ->whereBetween('check_in', [$checkin, $checkout])
                ->whereBetween('check_out', [$checkin, $checkout])
                ->count();
            if ($count_res > $value['amount'] ){
                return redirect('/listing/ ' . $rental->id . '/show' . '?')->with('Overboard', 'Overboard');
            } 
        }

        $user = Auth::user();
        $user->save();

        $user = $request->user();
        $final_trans = [];
        $subTotal = 0;
        $metadata = [];

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));


        $owner = $rental->TeamId->owner;
        $finalmeta = [];

        $products = $owner->getAllProductsForAccount();
        $final = [];
        $final_prod = "";

        if (count( $products->data ) !== 0) {
            foreach ($products as $product) {
                foreach ($res as $result) {

                    if ($product->name === $result['name'] && $product->metadata['roomtype_id'] == $result['id'] && $result['amount'] > 0) {
                        $final_prod = $product;
                        $res_prod = $result;

                        $price = $owner->getPricesForConnectedProduct($final_prod["id"])->data[0]->unit_amount;
                        $subTotal += $price * $res_prod["amount"];

                        array_push($finalmeta, [$res_prod["name"],  $final_prod->id, $res_prod["amount"], $res_prod["id"]]); 
                        array_push($final, 
                            array(
                                'price_data' => [
                                    'currency' => 'usd',
                                    'product_data' => ['name' => $res_prod['name']],
                                    'unit_amount' => $price,
                                ],
                                'quantity' => $res_prod["amount"],
                            )
                        );
                    }
                }
            }
        }

        parse_str(str_replace(' ', '%20', $url), $params);

        // Convert empty strings to null for cleaner JSON
        $params = array_map(function($value) {
            return ($value === '') ? null : $value;
        }, $params);

        $paramsServiceResult = [];
        foreach ($params as $key => $value) {
            if (str_starts_with($key, "Service")) {
                array_push($paramsServiceResult ,array($key => $value));
            }
        }
        $serviceFinalPrice = 0;

        if (count( $paramsServiceResult ) !== 0) {
            foreach ($paramsServiceResult as $key => $value) {
                $serviceFinalPrice += RoomService::find($value)[0]->cost * 100;
            }
        }

            array_push($final, 
            array(
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => 'Additional Services'],
                    'unit_amount' => $serviceFinalPrice,
                ],
                'quantity' => 1,
            )
        );

        $stripeFlatFee = 0.3;
        $stripeFee = 0.029;
        $totalFee = $stripeFlatFee + ($subTotal *  $stripeFee);

        array_push($final, 
            array(
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => 'Stripe Fee'],
                    'unit_amount' => round( $totalFee ),
                ],
                'quantity' => 1,
            )
        );

        array_push($metadata, $request->first_name); 
        array_push($metadata, $request->last_name); 
        array_push($metadata, $request->message); 
        array_push($metadata, json_encode($finalmeta)); 
        array_push($metadata, $checkin); 
        array_push($metadata, $checkout); 
        array_push($metadata, round( $totalFee )); 
        array_push($metadata, $owner->asStripeAccount()->id); 
        array_push($metadata,  false); 



        $user = Auth::user();

        if (!$user->hasStripeId()) {
            $stripeCustomer = $user->createAsStripeCustomer();

        }

        $stripeCustomer = $user->asStripeCustomer();

        $stripe->setupIntents->create
        (['customer' =>  $user->asStripeCustomer()->id,
        ]);


        $src = $stripe->customers->search(
            [
                'query' => 'name:\'' . $stripeCustomer->name .  '\' AND email:\'' . $stripeCustomer->email . '\' AND metadata[\'id\']:\'' .  $stripeCustomer->id . '\'',
            ],
                ['stripe_account' => $owner->asStripeAccount()->id]
            );
            $user = "";
            if (count($src) === 0) 
            {
                $user = $stripe->customers->create
                (
                    [
                        'name' => $stripeCustomer->name,
                        'email' => $stripeCustomer->email,
                        'metadata' => ['id' => $stripeCustomer->id],
                    ],
                    [
                        'stripe_account' =>  $owner->asStripeAccount()->id
                    ]
                );
            } else {
                $user = $src->data[0];
            }



        try {
            $stripe->accounts->update($owner->asStripeAccount()->id, [
                'capabilities' => [    
                    'card_payments' => ['requested' => true],    
                    'transfers' => ['requested' => true],  
                ],
            ]);
        } catch (\Throwable $th) {
            abort(404);
        }
        $stripecheckout = $stripe->checkout->sessions->create
        (
            [  
            'customer' =>  Auth::user()->asStripeCustomer()->id,
            'customer_update' => ['address' => 'auto'],
            'currency' => 'usd',
            'line_items' => [   
                    $final,
                ],

                'payment_intent_data' => [    
                    'transfer_data' => ['destination' =>  $owner->asStripeAccount()->id],
                  ],
                'invoice_creation' => [    
                    'enabled' => true,    

                    'invoice_data' => [      
                        'issuer' => ['type' => 'self'],
                        'description' => 'Invoice for ' . $owner->name,      
                        'rendering_options' => ['amount_tax_display' => 'include_inclusive_tax'],      
                        'footer' => 'Booking Hotel Online',
                    ],
                  ],
                  'automatic_tax' => 
                    [    
                        'enabled' => true,
                        'liability' => ['type' => 'self']
                    ],
                'mode' => 'payment',  
                'success_url' => route('cart.purchase') .'?session_id={CHECKOUT_SESSION_ID}&owner=' . $owner->id . '&url=' . $url,
                'cancel_url' => route('show.rental', [$rental]),
                'metadata' => [$metadata]
                ],
            );

        return redirect()->to($stripecheckout["url"]);
    }

    public function shoppingcartPurchase(Request $request) {

        $sessionId = $request->get('session_id');
        

        if ($sessionId === null) {
            return redirect()->route('/');
        }
        
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $owner = User::find($request->query('owner'))->asStripeAccount();
        $session = $stripe->checkout->sessions->retrieve($sessionId,['expand' => ['payment_intent']]);

        parse_str(str_replace(' ', '%20', $request->query('url')), $params);

        // Convert empty strings to null for cleaner JSON
        $params = array_map(function($value) {
            return ($value === '') ? null : $value;
        }, $params);

        $paramsServiceResult = [];
        foreach ($params as $key => $value) {
            if (str_starts_with($key, "Service")) {
                array_push($paramsServiceResult ,array($key => $value));
            }
        }

      
        if ($session['metadata'][8] === "true") {
            return redirect()->route('/');
        }

        $stripe->checkout->sessions->update
        (
            $sessionId,
            ['metadata' => ['8' => "true"]]
        );

        if ($session->status !== 'complete') {
            return redirect()->route('/');
        }

        if ($session->payment_status !== 'paid') {
            return redirect()->route('/');
        }

        if ($session->expire === 'expired') {
            return redirect()->route('/');
        }


        $invoice = $stripe->invoices->retrieve($session['invoice'], []);


        $orderId = $session['metadata'];


        $purchase = new CustomerPurchase;
        $purchase->user_id = Auth::user()->id;
        $purchase->total = $orderId[6];
        $purchase->receipt_url = $invoice->hosted_invoice_url;
        $purchase->save();

        $orders = json_decode($orderId[3]);



        foreach ($orders as $order) {

            $roomtype = RoomType::where('id', '=',  $order[3])->get()->first();

            $rental = Rental::where('id', '=', $roomtype->rental_id)->with("TeamId")->get()->first();

            $rooms = Room::where('room_type_id', '=', $roomtype->id)->get('*');

            $purchaseDetail = new CustomerPurchaseDetail;
            $purchaseDetail->user_id = Auth::user()->id;
            $purchaseDetail->purchase_id = $purchase->id;
            $purchaseDetail->rental_id = $rental->id;
            $purchaseDetail->room_type_id = $roomtype->id;
            $purchaseDetail->item_name = $roomtype->name . ' | ' . $rental->name;
            $purchaseDetail->price = $roomtype->price;
            $purchaseDetail->amount = $order[2];
            $purchaseDetail->save();


            foreach ($rooms as $key=>$room) {
                $count_res = Booking::Where('room_id', '=', $room->id)
                    ->whereBetween('check_in', [$orderId[4], $orderId[5]])
                    ->whereBetween('check_out', [$orderId[4], $orderId[5]])
                    ->count();

                if ($count_res == 0) {
                    $booking = new Booking;
                    $booking->rental_id = $roomtype->RentalId->id;
                    $booking->room_type_id = $roomtype->id;
                    $booking->team_id = $rental->team_id;
                    $booking->user_id = Auth::user()->id;
                    $booking->room_id = $room->id;
                    $booking->check_in = $orderId[4];
                    $booking->check_out = $orderId[5];
                    $booking->save();

                    $roomtypeService = RoomService::all()->where('room_type_id' , '=', $roomtype->id);
                    foreach ($roomtypeService as $key => $value) {
                        if ($value->cost == 0) {
                            $PD = new BookingDetail;
                            $PD->booking_id = $booking->id;
                            $PD->service_id = $value->id;
                            $PD->active = true;
                            $PD->save();
                        }
                        else 
                        {
                            $isPaid = false;
                            foreach ($paramsServiceResult as $key => $value) {
                                if (str_starts_with($key, "Service_" . $value->id . '_' . $roomtype->id)) {
                                    $isPaid = true;
                                }
                            }

                            $PD = new BookingDetail;
                            $PD->booking_id = $booking->id;
                            $PD->service_id = $value->id;
                            $PD->active = $isPaid;
                            $PD->save();
                        }
                    }
                }
            }
        }
        return redirect('/listing/ ' . $rental->id . '/show')->with('Success', 'Success');
    }
}
