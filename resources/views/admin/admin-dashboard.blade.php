<x-guest-layout>
    <x-original.dashboard>
        <div class="mt-2 bg-yellow-100 border border-yellow-200 text-sm text-yellow-800 rounded-lg p-4 dark:bg-yellow-800/10 dark:border-yellow-900 dark:text-yellow-500"
            role="alert" tabindex="-1" aria-labelledby="hs-soft-color-warning-label">
            <span id="hs-soft-color-warning-label" class="font-bold">Note</span> For a more full information please go
            the Admin Dashboard in Stripe.
        </div>
        <div class="block lg:flex">
            <div class="lg:w-1/2 mr-4  w-full bg-white rounded-lg p-8">
                <p class="text-sm uppercase mb-2 text-80">
                    {{ __('Available Balance') }}
                </p>
                <hr class="py-2" />
                <div>
                    <p class="text-2xl  text-green-600">
                        {{ __(strtoupper($currentBalance[0]) . ' ' . strtoupper($currentBalance[1])) }}
                    </p>
                </div>
            </div>

            <div class="lg:w-1/2 ml-4 w-full bg-white rounded-lg p-8">
                <p class="text-sm uppercase mb-2 text-80">
                    {{ __('Pending Balance') }}
                </p>
                <hr class="py-2" />
                <div>
                    <p class="text-2xl text-yellow-600">
                        {{ __(strtoupper($pending[0]) . ' ' . strtoupper(string: $pending[1])) }}
                    </p>
                </div>
            </div>
        </div>
    </x-original.dashboard>
</x-guest-layout>