<x-guest-layout>
    <form action="{{ Route('cart.checkout', [$rental, $url . '&' . Request::getQueryString(), $checkin, $checkout]) }}">
        @csrf
        <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

                <div class=" md:gap-6 flex-col lg:flex lg:items-start xl:gap-8">

                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Booking Confirmation
                            Form</h2>

                        <div class="flex w-full flex-row gap-8">
                            <div class=" mt-8">
                                <div class="flex justify-between items-center">
                                    <label for="with-corner-hint" class="block text-sm font-medium mb-2">First
                                        Name</label>
                                </div>
                                <input type="text" id="with-corner-hint"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                    placeholder="John" name="first_name">
                            </div>
                            <div class=" mt-8">
                                <div class="flex justify-between items-center">
                                    <label for="with-corner-hint" class="block text-sm font-medium mb-2">Last
                                        Name</label>
                                </div>
                                <input type="text" id="with-corner-hint"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                    placeholder="Doe" name="last_name">
                            </div>
                        </div>

                        <div class=" w-full">
                            <div class="w-full  mt-8">
                                <div class="flex justify-between items-center">
                                    <label for="with-corner-hint" class="block text-sm font-medium mb-2">Message</label>
                                </div>
                                <x-textarea id="number" class="block mt-1 w-full number" name="desc"
                                    placeholder="Description..." name="message" required autofocus></x-textarea>
                            </div>

                        </div>
                        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl mt-8">

                            <div
                                class="space-y-4  rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

                                <div class="space-y-4">
                                    @foreach ($res as $result)
                                        <dl
                                            class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                            <dt class="text-base font-bold text-gray-900 dark:text-white">
                                                <span class="flex flex-col">
                                                    <span>
                                                        {{ $result['name'] }}
                                                        @if ($result['amount'] > 0)
                                                            <span class="opacity-60">({{$result['amount']}}x)</span>
                                                            <input name="{{ str_replace(' ', '', $result['name']) }}RoomAmount"
                                                                type="number" name="" value="{{ $result['amount'] }}" hidden>
                                                        @endif

                                                    </span>
                                                    <span class="opacity-60">
                                                        {{ $rental->name }}

                                                    </span>
                                                </span>

                                            </dt>
                                            <dd class="text-base font-bold text-gray-600 dark:text-white">
                                                {{ $result['price'] * $result['amount']}} USD
                                            </dd>
                                        </dl>
                                    @endforeach
                                    <dl
                                        class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                        <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                        <dd class="text-base font-bold text-red-600 dark:text-white">
                                            @php
                                                $total = 0;

                                                foreach ($res as $result) {
                                                    # code...
                                                    $total += $result['price'] * $result['amount'];
                                                }

                                                echo $total . ' USD';
                                            @endphp
                                        </dd>
                                    </dl>
                                </div>
                                <button
                                    class="flex w-full items-center justify-center rounded-lg bg-indigo-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed
                                    to Checkout</button>

                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </section>
    </form>
</x-guest-layout>