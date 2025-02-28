<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\StripeClient;

class DashboardController
{

    public function sessionAccountLogin() {
        $stripe = new \Stripe\StripeClient('sk_test_51QacjhJQ4w1zBP0WxWcu3YGdegjfp8kBoVrYq1StJgMzgM6SIiJkFWyXo4PtOFTMItZy8qoHD8Z8QbghyXv9KGSN005QO8fpbo');
        try {
        return response()->json(json_encode($stripe->accounts->createLoginLink(Auth::user()->asStripeAccount()->id, [])), 200);
        } catch (\Exception $e) {
            response()->json(json_encode(['error' => $e->getMessage()]), '500')->sendContent();
        }
    }

    public function sessionPayment() {

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        try {
            $account_session = $stripe->accountSessions->create
            ([
                'account' => Auth::user()->asStripeAccount()->id,
                'components' => [
                    'payments' => [
                        'enabled' => true,
                        'features' => [
                            'refund_management' => true,
                            'dispute_management' => true,
                            'capture_payments' => true,
                        ],
                    ],
                ]
            ]);

            response()->json(json_encode(array(
                'client_secret' => $account_session->client_secret
            )), 200)->sendContent();
        } catch (\Throwable $e) {
            response()->json(json_encode(['error' => $e->getMessage()]), '500')->sendContent();
        }
    }

    public function sessionAccountManagement() {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        try {
            $account_session = $stripe->accountSessions->create
            ([
                'account' => Auth::user()->asStripeAccount()->id,
                'components' => [    
                    'account_management' => [      
                        'enabled' => true,      
                        'features' => [
                            'external_account_collection' => true
                        ],
                    ],
                ],
            ]);

            response()->json(json_encode(array(
                'client_secret' => $account_session->client_secret
            )), 200)->sendContent();
        } catch (\Throwable $e) {
            response()->json(json_encode(['error' => $e->getMessage()]), '500')->sendContent();
        }
    }
    
    public function sessionBalance() {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        try {
            $account_session = $stripe->accountSessions->create
            ([
                'account' => Auth::user()->asStripeAccount()->id,
                'components' => [    
                    'balances' => [      
                        'enabled' => true,      
                        'features' => [        
                            'instant_payouts' => true,        
                            'standard_payouts' => true,        
                            'edit_payout_schedule' => true,      
                        ],    
                    ],  
                ],
            ]);

            response()->json(json_encode(array(
                'client_secret' => $account_session->client_secret
            )), 200)->sendContent();
        } catch (\Throwable $e) {
            response()->json(json_encode(['error' => $e->getMessage()]), '500')->sendContent();
        }
    }

    public function sessionDocuments() {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        try {
            $account_session = $stripe->accountSessions->create
            ([
                'account' => Auth::user()->asStripeAccount()->id,
                'components' => ['documents' => ['enabled' => true]],
            ]);

            response()->json(json_encode(array(
                'client_secret' => $account_session->client_secret
            )), 200)->sendContent();
        } catch (\Throwable $e) {
            response()->json(json_encode(['error' => $e->getMessage()]), '500')->sendContent();
        }
    }

    public function sessionPaymentSettings() {
        $stripe = new \Stripe\StripeClient([
            'api_key' => env('STRIPE_SECRET'),
            'stripe_version' => '2025-01-27.acacia; embedded_connect_beta=v1;',
        ]);

        try {
            $account_session = $stripe->accountSessions->create
            ([
                'account' => Auth::user()->asStripeAccount()->id,
                'components' => ['payment_method_settings' => ['enabled' => true]],
            ]);

            response()->json(json_encode(array(
                'client_secret' => $account_session->client_secret
            )), 200)->sendContent();
        } catch (\Throwable $e) {
            response()->json(json_encode(['error' => $e->getMessage()]), '500')->sendContent();
        }
    }


    public function sessionReportingChart() {
        $stripe = new \Stripe\StripeClient([
            'api_key' => env('STRIPE_SECRET'),
        ]);

        

        try {
            $account_session = $stripe->accountSessions->create
            ([
                'account' => Auth::user()->asStripeAccount()->id,
                'components' => [
                    'reporting_chart' => ['enabled' => true],
                ],
            ]);

            response()->json(json_encode(array(
                'client_secret' => $account_session->client_secret
            )), 200)->sendContent();
        } catch (\Throwable $e) {
            response()->json(json_encode(['error' => $e->getMessage()]), '500')->sendContent();
        }
    }

    public function sessionNotification() {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        try {
            $account_session = $stripe->accountSessions->create
            ([
                'account' => Auth::user()->asStripeAccount()->id,
                'components' => [    
                    'notification_banner' => [      
                        'enabled' => true,      
                        'features' => ['external_account_collection' => true],
                    ],
                ],
            ]);

            response()->json(json_encode(array(
                'client_secret' => $account_session->client_secret
            )), 200)->sendContent();
        } catch (\Throwable $e) {
            response()->json(json_encode(['error' => $e->getMessage()]), '500')->sendContent();
        }
    }

    public function sessionTaxRegistrations() {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        try {
            $account_session = $stripe->accountSessions->create
            ([
                'account' => Auth::user()->asStripeAccount()->id,
                'components' => ['tax_registrations' => ['enabled' => true]],
            ]);

            response()->json(json_encode(array(
                'client_secret' => $account_session->client_secret
            )), 200)->sendContent();
        } catch (\Throwable $e) {
            response()->json(json_encode(['error' => $e->getMessage()]), '500')->sendContent();
        }
    }

    public function sessionTaxSettings() {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        try {
            $account_session = $stripe->accountSessions->create
            ([
                'account' => Auth::user()->asStripeAccount()->id,
                'components' => ['tax_settings' => ['enabled' => true]],
            ]);

            response()->json(json_encode(array(
                'client_secret' => $account_session->client_secret
            )), 200)->sendContent();
        } catch (\Throwable $e) {
            response()->json(json_encode(['error' => $e->getMessage()]), '500')->sendContent();
        }
    }


}
