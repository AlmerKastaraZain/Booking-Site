<x-guest-layout>
    <x-original.dashboard>

        @if (!Auth::user()->hasStripeAccount())
            <x-welcome />
        @else
            <div id="info-error" class="mt-2 hidden bg-indigo-600 text-sm text-white rounded-lg p-4 dark:bg-blue-500"
                role="alert" tabindex="-1" aria-labelledby="hs-solid-color-info-label">
                <span id="hs-solid-color-info-label" class="font-bold">Error</span> Could not generate a Stripe Link.
            </div>
            <div id="info-link" class="mt-2 hidden bg-indigo-600 text-sm text-white rounded-lg p-4 dark:bg-blue-500"
                role="alert" tabindex="-1" aria-labelledby="hs-solid-color-info-label">
                <span id="hs-solid-color-info-label" class="font-bold">Info</span> alert! You should check your Stripe
                dashboard by clicking this <a class="underline" id="stripe-link">Link</a> for the
                full
                information.
            </div>

            <script defer>
                const fetchLink = async () => {
                    // Fetch the AccountSession client secret
                    const response = await fetch('/account_session/account-login', {
                        method: "get",
                        headers: {
                            "Content-Type": "application/json",
                        },
                    });
                    if (!response.ok) {
                        // Handle errors on the client side here
                        const { error } = await response.json();
                        console.log('An error occured when generating the link: ', error);
                        document.querySelector('#info-error').style.display = "block";
                    } else {
                        const res = await response.json();
                        document.querySelector('#info-link').style.display = "block";
                        document.querySelector('#stripe-link').href = JSON.parse(res).url;
                    }
                }
                fetchLink;
                fetchLink();
            </script>

            <div id="notification-container"></div>
            <div id="notification-error" hidden>Something went wrong!</div>

            <div class="bg-white rounded-lg p-6">
                <h1>Balance</h1>
                <div id="balance-container"></div>
                <div id="balance-error" hidden>Something went wrong!</div>
            </div>
            <div class="bg-white rounded-lg p-6">
                <h1>Documents</h1>
                <div id="documents-container"></div>
                <div id="documents-error" hidden>Something went wrong!</div>
            </div>
            <div class="bg-white rounded-lg p-6">
                <h1>Payments</h1>
                <div id="payment-container"></div>
                <div id="payment-error" hidden>Something went wrong!</div>
            </div>



            <script src="{{ asset('js/stripe-component/balance.js') }}" defer></script>
            <script src="{{ asset('js/stripe-component/notification.js') }}" defer></script>
            <script src="{{ asset('js/stripe-component/payment.js') }}" defer></script>
            <script src="{{ asset('js/stripe-component/documents.js') }}" defer></script>

        @endif

    </x-original.dashboard>
</x-guest-layout>