<x-guest-layout>
    <x-original.dashboard>
        <div class="w-full p-10 space-y-2 bg-white h-full rounded-lg">

            <p class="opacity-80">HotelBookingOnline.com</p>
            <hr />
            <h1 class=" font-bold pt-2"> <span class="text-xl">Current Subscriptions</span>
                @if (Auth::user()->subscriptions && Auth::user()->subscriptions[0]->stripe_status === "trialing")
                    <span class="opacity-60 text-md"> (On Trial) </span>
                @endif
            </h1>
            @if (Auth::user()->subscriptions && Auth::user()->subscriptions[0]->items[0]->stripe_product === env('STRIPE_MEMBERSHIP_PRODUCT_ONE'))
                <p class="text-xl font-black pb-4 text-indigo-600">Basic Plan</p>
            @else
                <p class="text-xl pb-4 text-gray-500">You have no active subscriptions</p>
            @endif
            <hr />
            @if (Auth::user()->subscriptions && Auth::user()->subscriptions[0]->stripe_status === "trialing")
                <p><span class="font-bold text-md">Trials will end at</span>
                    <span
                        class="opacity-80">{{ date("F jS, Y", strtotime(Auth::user()->subscriptions[0]->trial_ends_at)) }}</span>
                </p>
            @else
                <p><span class="font-bold text-md">Trials will end at</span>
                    <span
                        class="opacity-80">{{ date("F jS, Y", strtotime(Auth::user()->subscriptions[0]->ends_at)) }}</span>
                </p>
            @endif
            <div class="flex pt-4">
                <a href="{{ Route('cancel.billing.subscriptions') }}">
                    <button type="button"
                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none">
                        Ends Subscriptions
                    </button>
                </a>
            </div>
        </div>

        <div class="w-full p-10 flex flex-col gap-2 space-y-2 bg-white h-full rounded-lg">
            <h1 class=" font-bold pt-2"> <span class="text-xl">Are you connected?</span></h1>
            <p class="text-sm -mb-4 text-gray-500">This is needed for transaction in the site.</p>


            @if (Auth::user()->hasStripeAccount())
                <a href="{{ Route('create.stripe') }}">
                    <button type="button"
                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        Already been Connect
                    </button>
                </a>
            @else
                <a href="{{ Route('create.stripe') }}">
                    <button type="button"
                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none">
                        Connect
                    </button>
                </a>
            @endif


        </div>

        @if (Auth::user()->hasStripeAccount())
            <h1 class=" font-bold pt-2"> <span class="text-xl">Your Account Details</span></h1>

            <div class="bg-white rounded-lg p-6">
                <div id="account-management-container"></div>
                <div id="account-management-error" hidden>Something went wrong!</div>
            </div>
            <script src="{{ asset('js/stripe-component/account-management.js') }}" defer></script>

        @endif

        @if (Auth::user()->hasStripeAccount())
            <h1 class=" font-bold pt-2"> <span class="text-xl">Set Up your Taxes</span></h1>

            <div class="bg-white rounded-lg p-6">
                <h1>Tax Settings</h1>
                <div id="tax-settings-container"></div>
                <div id="tax-settings-error" hidden>Something went wrong!</div>
            </div>
            <div class="bg-white rounded-lg p-6">
                <h1>Register your Tax</h1>
                <div id="tax-registrations-container"></div>
                <div id="tax-registrations-error" hidden>Something went wrong!</div>
            </div>

            <script src="{{ asset('js/stripe-component/tax-settings.js') }}" defer></script>
            <script src="{{ asset('js/stripe-component/tax-registrations.js') }}" defer></script>
        @endif
    </x-original.dashboard>
</x-guest-layout>