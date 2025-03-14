<div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
    <div
        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
        <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

        <div class="space-y-4">
            @foreach ($bookings as $booking)
                <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                    <dt class="text-base font-bold text-gray-900 dark:text-white">
                        <span class="flex flex-col">
                            <span>
                                {{ $booking->RoomTypeId->name }}
                                @if ($booking->amount > 0)
                                    <span class="opacity-60">({{$booking->amount}}x)</span>
                                @endif

                            </span>
                            <span class="opacity-60">
                                {{ $booking->RentalId->name }}

                            </span>
                        </span>

                    </dt>
                    <dd class="text-base font-bold text-gray-600 dark:text-white">
                        {{ $booking->RoomTypeId->price * $booking->amount}} USD
                    </dd>
                </dl>
            @endforeach
            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                <dd class="text-base font-bold text-red-600 dark:text-white">
                    @php
                        $total = 0;

                        foreach ($bookings as $booking) {
                            # code...
                            $total += $booking->RoomTypeId->price * $booking->amount;
                        }

                        echo $total . ' USD';
                    @endphp
                </dd>
            </dl>
        </div>

        <a href="{{ Route('cart.checkout') }}"
            class="flex w-full items-center justify-center rounded-lg bg-indigo-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed
            to Checkout</a>

        <div class="flex items-center justify-center gap-2">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
            <a href="/" title=""
                class="inline-flex items-center gap-2 text-sm font-medium text-indigo-700 underline hover:no-underline dark:text-indigo-500">
                Continue Shopping
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
            </a>
        </div>
    </div>
</div>