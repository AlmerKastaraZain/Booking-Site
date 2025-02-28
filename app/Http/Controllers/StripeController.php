<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class StripeController
{

    /**
     * Creates an onboarding link and redirects the store there.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function board(Request $request): RedirectResponse
    {
        return $this->handleBoardingRedirect(Auth::user());
    }

    public function generateOnboardingURL(Request $request, User $user){

        $validated = $request->validate([
                "returnURL" => ['required'],
                "refreshURL" => ['required']
            ]);
    
        $store = $user;
    

        return response()->json((object)[
            "Url" => $store->accountOnboardingUrl($validated['returnURL'], $validated['refreshURL'])
        ]);
    }
    /**
     * Handles returning from completing the onboarding process.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function returning(Request $request): RedirectResponse
    {
        return $this->handleBoardingRedirect($request->store());
    }

    /**
     * Handles refreshing of onboarding process.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function refresh(Request $request): RedirectResponse
    {
        return $this->handleBoardingRedirect($request->store());
    }

    /**
     * Handles the redirection logic of Stripe onboarding for the given store. Will 
     * create account and redirect store to onboarding process or redirect to account 
     * dashboard if they have already completed the process.
     *
     * @param Store $Store
     * @return RedirectResponse
     */
    private function handleBoardingRedirect(User $user): RedirectResponse
    {
        // Redirect to dashboard if onboarding is already completed.
        if ($user->hasStripeAccount() && $user->hasCompletedOnboarding()) {
            return $user->redirectToAccountDashboard();
        }

        // Delete account if already exists and create new express account with 
        // weekly payouts.
        $user->deleteAndCreateStripeAccount('express', [
            'settings' => [
                'payouts' => [ 
                    'schedule' => [ 
                        'interval' => 'weekly', 
                        'weekly_anchor' => 'friday',
                    ]
                ]
            ]
        ]);
        
        // If you wish to acceess the new connected account via the related model
        // you must refresh the model using the refresh() model method.
        $user->refresh();

        // Redirect to Stripe account onboarding, with return and refresh url, otherwise.
        return $user->redirectToAccountOnboarding(
            URL::to(Route('dashboard')),
            URL::to('/api/stripe/refresh?api_token=' . $user->api_token)
        );
        
    }

}
