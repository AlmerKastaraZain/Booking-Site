<x-guest-layout>
    <x-original.dashboard>

        <h1 class="text-2xl font-black pb-5"> Create Room Type </h1>
        <form action="{{ Route('store.roomtype', ['rental' => $rental]) }}" method="POST">
            @csrf
            @foreach ($errors->all() as $error)
                <li class="ml-4 text-red-700">{{ $error }}</li>
            @endforeach
            <div class="mb-6 lg:flex gap-4">
                <div class="lg:w-[50%] w-[100%]">
                    <div class="flex gap-4">
                        <div class="w-full">
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                placeholder="Premium Room" required autofocus />
                        </div>
                    </div>

                    <div class=" flex gap-4">
                        <div class="w-full">
                            <x-label for="desc" value="{{ __('Description') }}" />
                            <x-textarea id="number" class="block mt-1 w-full number" name="desc"
                                placeholder="Room Type Description..." required autofocus></x-textarea>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-col gap-4 mt-6 justify-start">
                            <div class="w-full">
                                <div class="flex justify-start items-center">
                                    <label class="text-white bg-black px-2 mr-1 py-4 rounded-md"
                                        for="bed">Quantity</label>
                                    <!-- Input Number -->
                                    <div class="py-2 px-3 bg-white border border-gray-200 rounded-lg"
                                        data-hs-input-number='{
                                        "min": 0,
                                        "max": 10
                                      }'>
                                        <div class="w-full flex justify-between items-center gap-x-5">
                                            <div class="grow">
                                                <span class="block text-xs text-gray-500">
                                                    Adult
                                                </span>
                                                <input
                                                    class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                                    style="-moz-appearance: textfield;" type="number"
                                                    aria-roledescription="Number field" value="1" name="adult"
                                                    data-hs-input-number-input="">
                                            </div>
                                            <div class="flex justify-end items-center gap-x-1.5">
                                                <button type="button"
                                                    class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                    tabindex="-1" aria-label="Decrease"
                                                    data-hs-input-number-decrement="">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M5 12h14"></path>
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                    class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                    tabindex="-1" aria-label="Increase"
                                                    data-hs-input-number-increment="">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M5 12h14"></path>
                                                        <path d="M12 5v14"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full">
                                <div class="flex justify-start items-center">
                                    <label class="text-white bg-black px-2 mr-1 py-4 rounded-md"
                                        for="bed">Quantity</label>
                                    <!-- Input Number -->
                                    <div class="py-2 px-3 bg-white border border-gray-200 rounded-lg"
                                        data-hs-input-number='{
                                        "min": 0,
                                        "max": 10
                                      }'>
                                        <div class="w-full flex justify-between items-center gap-x-5">
                                            <div class="grow">
                                                <span class="block text-xs text-gray-500">
                                                    Children
                                                </span>
                                                <input
                                                    class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                                    style="-moz-appearance: textfield;" type="number"
                                                    aria-roledescription="Number field" value="1" name="children"
                                                    data-hs-input-number-input="">
                                            </div>
                                            <div class="flex justify-end items-center gap-x-1.5">
                                                <button type="button"
                                                    class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                    tabindex="-1" aria-label="Decrease"
                                                    data-hs-input-number-decrement="">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M5 12h14"></path>
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                    class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                    tabindex="-1" aria-label="Increase"
                                                    data-hs-input-number-increment="">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M5 12h14"></path>
                                                        <path d="M12 5v14"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full mt-4 flex ">
                                    <div class="flex justify-start items-center w-full">
                                        <label class="text-white bg-black px-2 mr-1 py-4 rounded-md"
                                            for="bed">Quantity</label>
                                        <!-- Input Number -->
                                        <div class="py-2 px-3 bg-white border border-gray-200 rounded-lg"
                                            data-hs-input-number='{
                                        "min": 0,
                                        "max": 10
                                      }'>
                                            <div class="w-full flex justify-between items-center gap-x-5">
                                                <div class="grow">
                                                    <span class="block text-xs text-gray-500">
                                                        Bed
                                                    </span>
                                                    <input
                                                        class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                                        style="-moz-appearance: textfield;" type="number"
                                                        aria-roledescription="Number field" value="1" name="bed"
                                                        data-hs-input-number-input="">
                                                </div>
                                                <div class="flex justify-end items-center gap-x-1.5">
                                                    <button type="button"
                                                        class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                        tabindex="-1" aria-label="Decrease"
                                                        data-hs-input-number-decrement="">
                                                        <svg class="shrink-0 size-3.5"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M5 12h14"></path>
                                                        </svg>
                                                    </button>
                                                    <button type="button"
                                                        class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                        tabindex="-1" aria-label="Increase"
                                                        data-hs-input-number-increment="">
                                                        <svg class="shrink-0 size-3.5"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M5 12h14"></path>
                                                            <path d="M12 5v14"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Input Number -->
                            </div>
                        </div>
                    </div>
                    <div class="pt-4"></div>
                    <label for="room">Price Per Night</label>
                    <div class="flex justify-center items-center">
                        <label class="text-white bg-black px-2 mr-1 py-1 rounded-md" for="bed">USD</label>
                        <x-input placeholder="0" value="0" name="price" type="number" required
                            class="h-8 w-full my-2 number" />
                    </div>

                    <div class="pt-4"></div>
                    <label for="room">Room size</label>
                    <div class="flex justify-center items-center">
                        <label class="text-white bg-black px-2 mr-1 py-1 rounded-md font-bold" for="bed">M²</label>
                        <x-input placeholder="0" value="0" name="size" type="number" required
                            class="h-8 w-full my-2 number" />
                    </div>


                </div>

                <div class="lg:w-[50%] lg:mt-0 mt-10 w-[100%]  flex flex-col  px-6">
                    <x-original.facilities>
                        <x-original.facilities-item name="can_smoke" value="Can Smoke" />
                    </x-original.facilities>


                    <x-original.rental-services />
                    <p class="opacity-60">Leave input as "0" or blank, if you want it to be free.</p>

                    <h1 class="font-bold mt-4">Room Facility</h1>
                    <x-original.facilities>
                        <x-original.facilities-item name="kitchen" value="Kitchen" />
                        <x-original.facilities-item name="air_conditioning" value="Air conditioning" />
                        <x-original.facilities-item name="private_pool" value="Private pool" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item name="balcony" value="Balcony" />
                        <x-original.facilities-item name="washing_machine" value="Washing machine" />
                        <x-original.facilities-item name="view" value="View" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item name="bathtub" value="Bathtub" />
                        <x-original.facilities-item name="hottub" value="Hottub" />
                        <x-original.facilities-item name="heating" value="Heating" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item name="refrigerator" value="Refrigerator" />
                        <x-original.facilities-item name="tv" value="TV" />
                        <x-original.facilities-item name="shower" value="Shower" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item name="toilet_paper" value="Toilet paper" />
                        <x-original.facilities-item name="hair_dryer" value="Hair dryer" />
                        <x-original.facilities-item name="coffee_maker" value="Coffee Maker" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item name="toaster" value="Toaster" />
                        <x-original.facilities-item name="sofa" value="Sofa" />
                        <x-original.facilities-item name="toilet" value="Toilet" />
                    </x-original.facilities>
                </div>



                <br />
            </div>
            <x-button onclick="return CheckDynamicOrFixedCheckbox()" class="gap-2 bg-indigo-700 ">

                <div class="w-3">
                    <x-fas-plus style="color: #fff" />
                </div>Create
            </x-button>

        </form>

        <script defer>
            document.querySelectorAll(".number").forEach(element => {
                element.addEventListener("input", function (e) {
                    const tgt = e.target;
                    if (tgt.type && tgt.type === "number") {
                        const val = tgt.value;
                        const nums = val.replace(/[^\d.-]/g, '');
                        if (!/\d+/.test(val)) tgt.value = "";
                    }
                })
            });


        </script>
    </x-original.dashboard>
</x-guest-layout>