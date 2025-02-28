<x-guest-layout>
    <x-original.dashboard>
        <h1 class="text-2xl font-black pb-5"> Edit Room Type </h1>
        <form action="{{ Route('update.roomtype', ['rental' => $rental, 'roomtype' => $roomtype]) }}">
            @csrf
            @foreach ($errors->all() as $error)
                <li class="ml-4 text-red-700">{{ $error }}</li>
            @endforeach
            <div class="mb-6 lg:flex gap-4">
                <div class="lg:w-[50%] w-[100%]">
                    <div class="flex gap-4">
                        <div class="w-full">
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" :value="$roomtype->name" class="block mt-1 w-full" type="text"
                                name="name" placeholder="Premium Room" required autofocus />
                        </div>
                    </div>

                    <div class=" flex gap-4">
                        <div class="w-full">
                            <x-label for="desc" value="{{ __('Description') }}" />
                            <x-textarea id="number" class="block mt-1 w-full number" name="desc"
                                placeholder="Room Type Description..." required
                                autofocus>{{ $roomtype->description }}</x-textarea>
                        </div>
                    </div>
                    <div>
                        <div class="flex gap-4 mt-6">
                            <div class="w-full">
                                <label for="adult">Adult</label>
                                <div class="flex justify-center items-center">
                                    <label class="text-white bg-black px-2 mr-1 py-1 rounded-md"
                                        for="bed">Quantity</label>
                                    <x-input placeholder="Adult" :value="$roomtype->adult" required name="adult"
                                        type="number" class="h-8 my-2 w-full number" />
                                </div>
                            </div>
                            <div class="w-full">
                                <label for="children">Children</label>
                                <div class="flex justify-center items-center">
                                    <label class="text-white bg-black px-2 mr-1 py-1 rounded-md"
                                        for="bed">Quantity</label>
                                    <x-input placeholder="Children" :value="$roomtype->child" required name="children"
                                        type="number" class="h-8 w-full my-2 number" />
                                </div>
                            </div>

                        </div>
                        <div class="w-full">
                            <label for="bed">Bed</label>
                            <div class="flex justify-center items-center">
                                <label class="text-white bg-black px-2 mr-1 py-1 rounded-md" for="bed">Quantity</label>
                                <x-input placeholder="Bed" :value="$roomtype->bed" name="bed" required type="number"
                                    class="h-8 w-full my-2 number" />
                            </div>
                        </div>
                    </div>
                    <label for="room">Price Per Night</label>
                    <div class="flex justify-center items-center">
                        <label class="text-white bg-black px-2 mr-1 py-1 rounded-md" for="bed">USD</label>
                        <x-input placeholder="0" :value="$roomtype->price" name="price" type="number" required
                            class="h-8 w-full my-2 number" />
                    </div>

                    <label for="room">Room size</label>
                    <div class="flex justify-center items-center">
                        <label class="text-white bg-black px-2 mr-1 py-1 rounded-md font-bold" for="bed">M²</label>
                        <x-input placeholder="0" :value="$roomtype->wide" name="size" type="number" required
                            class="h-8 w-full my-2 number" />
                    </div>


                </div>

                <div class="lg:w-[50%] lg:mt-0 mt-10 w-[100%]  flex flex-col  px-6">
                    <x-original.facilities>
                        <x-original.facilities-item name="can_smoke" :checked="($roomtype->can_smoke === 1) ? 'true' : '' " value="Can Smoke" />
                    </x-original.facilities>


                    <x-original.rental-services
                        :wifi_check="(in_array(1, $service->pluck('service_id')->toArray() ) ) ? 'da' : ''"
                        :breakfast_check="(in_array(2, $service->pluck('service_id')->toArray() ) ) ? 'da' : ''"
                        :service_check="(in_array(3, $service->pluck('service_id')->toArray() ) ) ? 'da' : ''"
                        :wifi_cost="(in_array(1, $service->pluck('service_id')->toArray() ) ) ? $service[0]->cost : '0'"
                        :breakfast_cost="(in_array(2, $service->pluck('service_id')->toArray() ) ) ? $service[1]->cost : '0'"
                        :service_cost="(in_array(3, $service->pluck('service_id')->toArray() ) ) ? $service[2]->cost : '0'" />

                    <p class="opacity-60">Leave input as "0" or blank, if you want it to be free.</p>

                    <h1 class="font-bold mt-4">Room Facility</h1>
                    <x-original.facilities>
                        <x-original.facilities-item :checked="in_array(1, $facilities) ? 'a' : '' " name="kitchen"
                            value="Kitchen" />
                        <x-original.facilities-item :checked="in_array(2, $facilities) ? 'a' : ''"
                            name="air_conditioning" value="Air conditioning" />
                        <x-original.facilities-item :checked="in_array(3, $facilities) ? 'a' : ''" name="private_pool"
                            value="Private pool" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item :checked="in_array(4, $facilities) ? 'a' : ''" name="balcony"
                            value="Balcony" />
                        <x-original.facilities-item :checked="in_array(5, $facilities) ? 'a' : ''"
                            name="washing_machine" value="Washing machine" />
                        <x-original.facilities-item :checked="in_array(6, $facilities) ? 'a' : ''" name="view"
                            value="View" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item :checked="in_array(7, $facilities) ? 'a' : ''" name="bathtub"
                            value="Bathtub" />
                        <x-original.facilities-item :checked="in_array(8, $facilities) ? 'a' : ''" name="hottub"
                            value="Hottub" />
                        <x-original.facilities-item :checked="in_array(9, $facilities) ? 'a' : ''" name="heating"
                            value="Heating" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item :checked="in_array(10, $facilities) ? 'a' : ''" name="refrigerator"
                            value="Refrigerator" />
                        <x-original.facilities-item :checked="in_array(11, $facilities) ? 'a' : ''" name="tv"
                            value="TV" />
                        <x-original.facilities-item :checked="in_array(12, $facilities) ? 'a' : ''" name="shower"
                            value="Shower" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item :checked="in_array(13, $facilities) ? 'a' : ''" name="toilet_paper"
                            value="Toilet paper" />
                        <x-original.facilities-item :checked="in_array(14, $facilities) ? 'a' : ''" name="hair_dryer"
                            value="Hair dryer" />
                        <x-original.facilities-item :checked="in_array(15, $facilities) ? 'a' : ''" name="coffee_maker"
                            value="Coffee Maker" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item :checked="in_array(16, $facilities) ? 'a' : ''" name="toaster"
                            value="Toaster" />
                        <x-original.facilities-item :checked="in_array(17, $facilities) ? 'a' : ''" name="sofa"
                            value="Sofa" />
                        <x-original.facilities-item :checked="in_array(18, $facilities) ? 'a' : ''" name="toilet"
                            value="Toilet" />
                    </x-original.facilities>
                </div>



                <br />
            </div>
            <x-button onclick="return CheckDynamicOrFixedCheckbox()" class="gap-2 bg-indigo-700 ">
                <div class="w-3">
                    <x-fas-plus style="color: #fff" />
                </div>Update
            </x-button>
            <a href="{{ route('image.roomtype', ['rental' => $rental, 'roomtype' => $roomtype]) }}">
                <div onclick="preventDefault()"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 gap-2 bg-indigo-700 ">
                    <div class="w-3">
                        <x-fas-plus style="color: #fff" />
                    </div>Manage Image
                </div>
            </a>
        </form>



        <form method="post" class="pt-2"
            action="{{ route('store.room', ['rental' => $rental, 'roomtype' => $roomtype]) }}">
            <h1 class="pt-8"></h1>
            <hr class="pt-6">
            <h1 class="text-2xl  pt-2 font-black pb-5"> Create Rooms </h1>

            @csrf

            <x-button class="gap-2 bg-black ">
                <div class="w-3">
                    <x-fas-plus style="color: #fff" />
                </div>Create Room
            </x-button>
        </form>


        <livewire:room-table rental='{{ $rental->id }}' roomtype='{{ $roomtype->id }}' />

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