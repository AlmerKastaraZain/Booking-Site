<x-guest-layout>

    <div id="hs-full-screen-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="hs-full-screen-label">
        <div
            class="hs-overlay-open:mt-0 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-10 opacity-0 transition-all max-w-full max-h-full h-full">
            <div class="flex flex-col bg-white pointer-events-auto max-w-full max-h-full h-full dark:bg-neutral-800">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 id="hs-full-screen-label" class="font-bold text-gray-800 dark:text-white">
                        Gallery
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#hs-full-screen-modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <p class="mt-1 text-gray-800 dark:text-neutral-400">
                    <div class="image-gallery">
                        @foreach ($rentalImages as $rentalImage)
                            <div class="image-card flex justify-center items-center bg-gray-50">
                                <img class="object-contain w-full h-full"
                                    src="{{url(Storage::url('public/rental_images/' . $rentalImage->src))}}"
                                    alt="Secondary view" />
                            </div>
                        @endforeach
                    </div>
                    </p>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 mt-auto border-t dark:border-neutral-700">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        data-hs-overlay="#hs-full-screen-modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    @foreach ($roomTypes as $key => $roomType)
        <div id="{{ 'roomtype' . '-' . str_replace(' ', '', $roomType->name) }}"
            class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog" tabindex="-1"
            aria-labelledby="{{ 'roomtype' . '-' . str_replace(' ', '', $roomType->name) }}-label">
            <div
                class="hs-overlay-open:mt-0 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-10 opacity-0 transition-all max-w-full max-h-full h-full">
                <div class="flex flex-col bg-white pointer-events-auto max-w-full max-h-full h-full dark:bg-neutral-800">
                    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                        <h3 id="hs-full-screen-label" class="font-bold text-gray-800 dark:text-white">
                            {{ $roomType->name }}
                        </h3>
                        <button type="button"
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                            aria-label="Close"
                            data-hs-overlay="{{ '#roomtype' . '-' . str_replace(' ', '', $roomType->name) }}">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 flex pt-12 flex-row overflow-hidden">
                        <div class="w-full flex flex-col gap-4">
                            <h3 class="text-4xl text-black dark:text-white">{{ $roomType->name }}</h3>
                            <p class="text-black"><span class="bg-black text-white p-2 text-lg rounded-sm font-bold">Price / Per Night</span> <span class="text-lg p-2">{{ $roomType->price . ' USD' }} </span></p>
                            <p class="text-black"><span class="bg-black text-white p-2 text-lg rounded-sm font-bold">Beds Amount</span> <span class="text-lg p-2">{{ $roomType->bed }} </span></p>
                            <div class="flex ">
                                <span class="bg-black text-white p-2 text-lg rounded-sm font-bold">  Max Guest </span> 
                                <span class="text-lg h-full pt-3">
                                    <div class="flex pl-2">
                                        @foreach (range(1, $roomType->adult) as $i)
                                            <div class="w-5">
                                                {{ svg('elusive-adult') }}
                                            </div>
                                        @endforeach
                                    +
                                        @foreach (range(1, $roomType->child) as $i)
                                            <div class="w-3">
                                                {{ svg('fas-child') }}
                                            </div>
                                        @endforeach
                                    </div>
                                </span>
                            </div>
                    <hr />  

                            <p>{{ $roomType->description }} </p>
                        </div>


                        @php
                            $filled = false;

                            foreach ($roomImages as $key => $image) {
                                if ($image->room_id === $roomType->id) {
                            $filled = true;
                                }
                            }
                        @endphp
                        @if ($filled)
                        <div  class="w-1/2">

                            <!-- Slider main container -->
                            <div class="swiper {{ 'swiper-' . $key }}" style=" height: 720px; overflow: hidden;">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper {{ 'swiper-wrapper-' . $key }} " style="">
                                    <!-- Slides -->
                                        @foreach ($roomImages as $image)
                                            @if ($image->room_id === $roomType->id)
                                                <div class="swiper-slide" class="bg-no-repeat " style="background-repeat: no-repeat; background-size: contain; background-position: center; background-image: url('{{ asset('storage/room_images/' . $image->src)}}')">
                                                </div>
                                            @endif

                                        @endforeach
                                    </div>

                                    <!-- If we need pagination -->
                                    <div class="b-4 swiper-pagination {{ 'swiper-pagination-'  . $key}}"></div>

                                    <!-- If we need navigation buttons -->
                                    <div class="swiper-button-prev {{ 'swiper-button-prev-'  . $key}} transition-all"></div>
                                    <div class="swiper-button-next {{ 'swiper-button-next-'  . $key}} transition-all"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <script>
                        new Swiper(".swiper-" + "{{ $key }}", {
                            slidesPerView: 3,
                            spaceBetween: 24,
                            pagination: {
                                el: ".swiper-pagination-" + "{{ $key }}",
                                clickable: true
                            },
                            navigation: 
                                nextEl: ".swiper-button-next-" + "{{ $key }}",
                                prevEl: ".swiper-button-prev-" + "{{ $key }}"
                            },
                            watchSlidesProgress: true
                        });
                    </script>

                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 mt-auto border-t dark:border-neutral-700">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            data-hs-overlay="{{ '#roomtype' . '-' . str_replace(' ', '', $roomType->name) }}">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <x-original.guest-navbar id="guest-navbar">

        <div class="max-w-[85rem]  min-h-[75rem] bg-white mx-auto py-10 px-4 sm:px-6 lg:px-8">


            @if ($rental->status_id == 1)
                <div class="mb-2 bg-red-500 text-sm text-white rounded-lg p-4" role="alert" tabindex="-1"
                    aria-labelledby="hs-solid-color-danger-label">
                    <span id="hs-solid-color-danger-label" class="font-bold">Denied</span> This property has been denied.
                    Please resend submission.
                </div>
            @elseif ($rental->status_id == 2)
                <div class="mb-2 bg-yellow-500 text-sm text-white rounded-lg p-4" role="alert" tabindex="-1"
                    aria-labelledby="hs-solid-color-warning-label">
                    <span id="hs-solid-color-warning-label" class="font-bold">Warning</span> This property has not been
                    approved yet. Wait for admin approval. Property that is waiting for review cannot be seen or used by
                    Guest.
                </div>
            @endif

            @if (session('successPurchase'))
                <div class="mt-2 space-y-2 mb-2 bg-teal-500 text-sm text-white rounded-lg p-4" role="alert" tabindex="-1"
                    aria-labelledby="hs-solid-color-success-label">
                    <span id="hs-solid-color-success-label" class="font-bold">Success</span> Items has been purchased!
                </div>
            @endif
            @if (session('vendorAndAdmin'))
                <div class="mt-2  space-y-2 mb-2 bg-red-500 text-sm text-white rounded-lg p-4" role="alert" tabindex="-1"
                    aria-labelledby="hs-solid-color-success-label">
                    <span id="hs-solid-color-success-label" class="font-bold">Failed</span> As an Admin, or Vendor. You cannot make a transaction with vendors...
                </div>
            @endif
            @if (session('DateError'))
            <div class="mt-2  space-y-2 mb-2 bg-red-500 text-sm text-white rounded-lg p-4" role="alert" tabindex="-1"
                aria-labelledby="hs-solid-color-success-label">
                <span id="hs-solid-color-success-label" class="font-bold">Failed</span> Please fill out date correctly, or set your date correctly...
            </div>
        @endif
            @if (session('Overboard'))
                <div class="mt-2  space-y-2 mb-2 bg-red-500 text-sm text-white rounded-lg p-4" role="alert" tabindex="-1"
                    aria-labelledby="hs-solid-color-success-label">
                    <span id="hs-solid-color-success-label" class="font-bold">Failed</span> Current booking is not available...
                </div>
            @endif
            @if (session('General Error'))
                <div class="mt-2  space-y-2 mb-2 bg-red-500 text-sm text-white rounded-lg p-4" role="alert" tabindex="-1"
                    aria-labelledby="hs-solid-color-success-label">
                    <span id="hs-solid-color-success-label" class="font-bold">Failed</span> Something has gone wrong...
                </div>
            @endif
            @if (session('Success'))
            <div class="mt-2  space-y-2 mb-2 bg-green-600 text-sm text-white rounded-lg p-4" role="alert" tabindex="-1"
            aria-labelledby="hs-solid-color-success-label">
                <span id="hs-solid-color-success-label" class="font-bold">Success</span> Your transaction have succeded, Check dashboard to see your bookings and purchases.
            </div>
            @endif
            <div>



                <div class="flex items-center">
                    <h1 class="text-3xl font-bold px-2">{{ $rental->name }}</h1>

                    
                </div>
                <div class="flex mb-4 gap-1 py-2 px-2 items-center">
                    <div class="w-4">
                        @svg('zondicon-location')
                    </div>

                    <p class="text-1xl ">{{ $rental->full_address }}</p>

                </div>

            </div>
            @if ($rentalImages->count() !== 0)
                <div class="xl:flex hidden image-grid">
                    @if ($rentalImages->count() >= 1)

                        <div class="image-box main cursor-pointer relative gallery" aria-haspopup="dialog" aria-expanded="false"
                            aria-controls="hs-full-screen-modal" data-hs-overlay="#hs-full-screen-modal">

                            <img class="main-img" src="{{url(Storage::url('public/rental_images/' . $rentalImages[0]->src))}}"
                                alt="Main view" />
                        </div>
                    @endif

                    <div class="image-box second">
                        <div class="image-row">
                            @if ($rentalImages->count() >= 2)
                                <div class="relative  cursor-pointer gallery" aria-haspopup="dialog" aria-expanded="false"
                                    aria-controls="hs-full-screen-modal" data-hs-overlay="#hs-full-screen-modal">

                                    <img src="{{url(Storage::url('public/rental_images/' . $rentalImages[1]->src))}}"
                                        alt="Secondary view" />
                                </div>
                            @endif
                            @if ($rentalImages->count() >= 3)
                                <div class="relative cursor-pointer gallery" aria-haspopup="dialog" aria-expanded="false"
                                    aria-controls="hs-full-screen-modal" data-hs-overlay="#hs-full-screen-modal">

                                    <img class="object-contain"
                                        src="{{url(Storage::url('public/rental_images/' . $rentalImages[2]->src))}}"
                                        alt="Secondary view" />
                                </div>
                            @endif

                        </div>
                        <div class="image-row">
                            @if ($rentalImages->count() >= 4)
                                <div class="relative cursor-pointer gallery" aria-haspopup="dialog" aria-expanded="false"
                                    aria-controls="hs-full-screen-modal" data-hs-overlay="#hs-full-screen-modal">

                                    <img src="{{url(Storage::url('public/rental_images/' . $rentalImages[3]->src))}}"
                                        alt="Secondary view" />
                                </div>
                            @endif
                            @if ($rentalImages->count() >= 5)
                                <div class="relative cursor-pointer gallery" aria-haspopup="dialog" aria-expanded="false"
                                    aria-controls="hs-full-screen-modal" data-hs-overlay="#hs-full-screen-modal">

                                    <img src="{{url(Storage::url('public/rental_images/' . $rentalImages[4]->src))}}"
                                        alt="Secondary view" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="max-xl:flex hidden overflow-visible">
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach ($rentalImages as $rentalImage)
                                <div class="swiper-slide cursor-pointer relative" aria-haspopup="dialog" aria-expanded="false"
                                    aria-controls="hs-full-screen-modal" data-hs-overlay="#hs-full-screen-modal">>

                                    <img class="w-full h-full"
                                        src="{{url(Storage::url('public/rental_images/' . $rentalImage->src))}}"
                                        alt="Secondary view" />
                                </div>
                            @endforeach
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev hover:shadow-lg transition-all"></div>
                        <div class="swiper-button-next transition-all"></div>

                        <!-- If we need scrollbar -->
                        <div class="swiper-scrollbar"></div>
                    </div>

                    <style>
                        .swiper {
                            height: 70vw;
                        }

                        .swiper-button-next,
                        .swiper-button-prev {
                            color: black;
                            border: 1px solid black;

                            background-color: white;
                            border-radius: 50%;
                            width: 50px;
                            height: 50px;
                        }

                        .swiper-button-next:hover {
                            translate: 0;
                        }


                        .swiper-button-next {
                            translate: -4px;
                        }

                        .swiper-button-prev:hover {
                            translate: 0;
                        }

                        .swiper-button-prev {
                            translate: 4px;

                        }

                        .swiper-button-next:hover,
                        .swiper-button-prev:hover {
                            color: white;
                            background-color: black;

                            outline: black solid 6px;
                        }


                        .swiper-button-next::after,
                        .swiper-button-prev::after {
                            scale: 0.6;
                        }

                        .swiper-pagination-bullet {
                            background-color: black;
                        }
                    </style>
                    <script>
                        var swiper = new Swiper('.swiper', {
                            slidesPerView: 1.1,
                            centeredSlides: true,
                            spaceBetween: 20,
                            pagination: {
                                el: '.swiper-pagination',
                            },

                            // Navigation arrows
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },

                            // And if we need scrollbar
                            scrollbar: {
                                el: '.swiper-scrollbar',
                            },
                        });
                    </script>
                </div>
            @endif

            <div class="xl:flex block pt-6 pb-6">
                <div class="max-xl:w-full max-xl:pt-8 w-1/2">

                    <div class="flex items-center gap-x-3 px-2">
                        <div class="shrink-0">
                            <img class="shrink-0 size-16 rounded-full"
                            src="{{ ($userOwner->profile_photo_path == '') ? "https://ui-avatars.com/api/?name=" . $userOwner->name[0]  . "&color=7F9CF5&background=EBF4FF" : $userOwner->profile_photo_path}}"
                            alt="Avatar">

                        </div>

                        <div class="grow">
                            <h1 class="text-lg font-medium text-black ">
                                {{ $userOwner->name }}
                            </h1>
                            <p class="text-sm text-gray-600">
                                {{ 'Vendor '}}
                            </p>
                        </div>
                    </div>
                    <hr class="my-4 w-[95%]" />
                    <div>
                        
                        {{ $rental->description }}
                    </div>

                </div>
                <div class="max-xl:w-full max-xl:pt-8 w-1/2">
                    <div id="map"></div>

                    <script
                        src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_API')}}&callback=initMap&libraries=places&v=weekly"
                        defer></script>
                    <script>
                        const marker = new google.maps.Marker({ map: map });


                        function initMap() {
                            const map = new google.maps.Map(document.getElementById("map"), {
                                center: { lat: -33.8688, lng: 151.2195 },
                                zoom: 13,
                            });
                            const marker = new google.maps.Marker({ map: map });

                            let latitude = "{{$rental->latitude}}";
                            let longitude = "{{$rental->longitude}}";
                            marker.setPosition({
                                lat: parseFloat(latitude),
                                lng: parseFloat(longitude)
                            })
                            map.setCenter({
                                lat: parseFloat(latitude),
                                lng: parseFloat(longitude)
                            });
                        }
                    </script>
                </div>
            </div>
            <hr>
            <h1 class="text-3xl font-bold px-2 pt-6 pb-2">{{ 'Ketersediaan' }}</h1>
            <form action="">
                <div class="max-w-[100vw] mb-6 z-10 lg:w-1/2 w-full">
                    <div class="flex  max-lg:flex-col bg-yellow-500 p-1 gap-1 rounded-l-md rounded-r-md w-full">
                        <div class="w-[60%] cursor-pointer max-xl:w-full bg-white flex relative items-center h-12">
                            <div id="range-calendar" class="w-full h-full absolute top-0 left-0 ">
                                <div class="w-full h-full"></div>
                            </div>
                            <div class="flex items-center">
                                <div class="pl-2 flex justify-center items-center">
                                    <div class="w-6 text-slate-600">
                                        @svg('zondicon-calendar')
                                    </div>
                                </div>
                                <p id="text-calendar" class="w-full ml-2 text-sm h-full">Sen, 10 Feb - Sen, 10 Feb</p>
                                <input id="hidden-calendar-check-in" class="invisible hidden" type="text" name="checkin"
                                    id="calendar">
                                <input id="hidden-calendar-check-out" class="invisible hidden" type="text"
                                    name="checkout" id="calendar">
                            </div>
                        </div>

                        <div class="w-[60%] relative cursor-pointer max-xl:w-full bg-white  z-10  h-12">
                            <div id="people-button" class="flex items-center h-full">
                                <div class="pl-2 flex justify-center items-center">
                                    <div class="w-6 text-slate-600">
                                        {{ svg('elusive-adult') }}
                                    </div>
                                </div>
                                <div id="people-text"
                                    class="cursor-pointer flex items-center ml-2 text-sm w-full h-full border-none shadow-none rounded-none">
                                    @if ($request->query('adult') != "")
                                        {{ $request->query('adult') }} Adult
                                    @else
                                        {{ '2 Adult ' }}
                                    @endif
                                    @if ($request->query('children') != "")
                                        · {{ $request->query('children') }} Children
                                    @else
                                        · {{ '1 Children ' }}
                                    @endif
                                    @if ($request->query('room'))
                                        · {{ $request->query('room') }} Room
                                    @else
                                        · {{ '1 Room' }}
                                    @endif

                                    
                                    <!-- Address Input -->
                                    <x-input name="location"  id="autocomplete" placeholder="Location..." type="text" value="{{ $request->query('location') }}"
                                        class="no-focus hidden text-sm outline-none w-full h-full border-none shadow-none rounded-none" />
        
                                    <input type="text" id="street_address" name="street_address"
                                        value="{{ $request->query('street_address') }}" class="hidden">
                                    <input type="text" id="route" name="route" value="{{ $request->query('route') }}"
                                        class="hidden">
                                    <input type="text" id="country" name="country" value="{{ $request->query('country') }}"
                                        class="hidden">
                                    <input type="text" id="administrative_area_level_1"
                                        value="{{ $request->query('administrative_area_level_1') }}"
                                        name="administrative_area_level_1" class="hidden">
                                    <input type="text" id="administrative_area_level_2"
                                        value="{{ $request->query('administrative_area_level_2') }}"
                                        name="administrative_area_level_2" class="hidden">
                                    <input type="text" id="administrative_area_level_3"
                                        value="{{ $request->query('administrative_area_level_3') }}"
                                        name="administrative_area_level_3" class="hidden">
                                    <input type="text" id="administrative_area_level_4"
                                        value="{{ $request->query('administrative_area_level_4') }}"
                                        name="administrative_area_level_4" class="hidden">
                                    <input type="text" id="administrative_area_level_5"
                                        value="{{ $request->query('administrative_area_level_5') }}"
                                        name="administrative_area_level_5" class="hidden">
                                    <input type="text" id="administrative_area_level_6"
                                        value="{{ $request->query('administrative_area_level_6') }}"
                                        name="administrative_area_level_6" class="hidden">
                                    <input type="text" id="administrative_area_level_7"
                                        value="{{ $request->query('administrative_area_level_7') }}"
                                        name="administrative_area_level_7" class="hidden">
                                    <input type="text" id="locality" name="locality" value="{{ $request->query('locality') }}"
                                        class="hidden">
                                    <input type="text" id="postal_code" name="postal_code"
                                        value="{{ $request->query('postal_code') }}" class="hidden">
                                    <input type="text" id="latitude" name="latitude" value="{{ $request->query('latitude') }}"
                                        class="hidden">
                                    <input type="text" id="longitude" name="longitude" value="{{ $request->query('longitude') }}"
                                        class="hidden">
                                    <input type="text" id="full_address" name="full_address"
                                        value="{{ $request->query('full_address') }}" class="hidden">
                                </div>
                            </div>

                            <div id="people-panel"
                                class="w-80  transition-all overflow-hidden p-2 gap-2 translate-y-12  rounded-lg flex-col flex justify-center bg-white shadow-2xl  absolute top-0 left-0">
                                <!--- INPUT START --->
                                <div class="py-2 px-3 bg-white border border-gray-200 rounded-lg" data-hs-input-number='{
                                    "max": 10,
                                    "min": 0
                                }'>
                                    <div class="w-full flex justify-between items-center gap-x-5">
                                        <div class="grow">
                                            <span class="block text-xs text-gray-500">
                                                Adult
                                            </span>
                                            <input id="adult" name="adult"
                                                class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                                style="-moz-appearance: textfield;" type="number"
                                                aria-roledescription="Number field"
                                                value="{{ ($request->adult != "") ? $request->adult : "2" }}"
                                                data-hs-input-number-input="">
                                        </div>
                                        <div class="flex justify-end items-center gap-x-1.5">
                                            <button type="button"
                                                class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                </svg>
                                            </button>
                                            <button type="button"
                                                class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
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
                                <!-- End Input Number -->

                                <!--- INPUT START --->
                                <div class="py-2 px-3 bg-white border border-gray-200 rounded-lg" data-hs-input-number='{
                                    "max": 10,
                                    "min": 0
                                }'>
                                    <div class="w-full flex justify-between items-center gap-x-5">
                                        <div class="grow">
                                            <span class="block text-xs text-gray-500">
                                                Children
                                            </span>
                                            <input id="children" name="children"
                                                class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                                style="-moz-appearance: textfield;" type="number"
                                                aria-roledescription="Number field"
                                                value="{{ ($request->children != "") ? $request->children : "1" }}"
                                                data-hs-input-number-input="">
                                        </div>
                                        <div class="flex justify-end items-center gap-x-1.5">
                                            <button type="button"
                                                class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                </svg>
                                            </button>
                                            <button type="button"
                                                class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
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
                                <!-- End Input Number -->

                                <!--- INPUT START --->
                                <div class="py-2 px-3 bg-white border border-gray-200 rounded-lg" data-hs-input-number='{
                                    "max": 10,
                                    "min": 1
                                }'>
                                    <div class="w-full flex justify-between items-center gap-x-5">
                                        <div class="grow">
                                            <span class="block text-xs text-gray-500">
                                                Room
                                            </span>
                                            <input
                                                class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                                                style="-moz-appearance: textfield;" type="number"
                                                aria-roledescription="Number field"
                                                value="{{ ($request->room) ? $request->room : "1" }}" id="room"
                                                name="room" data-hs-input-number-input="">
                                        </div>
                                        <div class="flex justify-end items-center gap-x-1.5">
                                            <button type="button"
                                                class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                </svg>
                                            </button>
                                            <button type="button"
                                                class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
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
                                <!-- End Input Number -->
                                <hr class="mt-2 mb-2">
                                <div class="grid sm:grid-cols-2 gap-2">
                                    <label for="hs-checkbox-in-form"
                                        class="flex p-3 w-[205%] bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 ">
                                        <input id="pet" name="pet" type="checkbox"
                                            class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none  dark:"
                                            id="hs-checkbox-in-form">
                                        <span class="text-sm text-black ms-3 ">Travelling with
                                            Pets?</span>

                                    </label>

                                </div>
                                <span class="text-gray-500 pl-2">
                                    Assistance animals aren’t considered pets.

                                </span>

                                <x-button onclick="SetGuestSearch();"
                                    class="w-full tounded-md h-[40px]  bg-indigo-800">Done</x-button>

                            </div>
                        </div>
                        <a href="{{ Route('show.rental', $rental) }}">
                            <x-button class="w-full h-full rounded-r-md rounded-none bg-indigo-800">Search</x-button>
                        </a>
                    </div>

                    <script defer>
                        const widthOuter = function (elem) {
                            if (elem) {
                                return elem.clientWidth;
                            }
                        }

                        const el = document.getElementById('range-calendar')

                        const text = document.getElementById('text-calendar')
                        const calendarInput = document.getElementById("hidden-calendar")
                        function join(date, options, separator) {
                            function format(option) {
                                let formatter = new Intl.DateTimeFormat('UTC', option);
                                return formatter.format(date);
                            }
                            return options.map(format).join(separator);
                        }

                        const inputCheckIn = document.getElementById('hidden-calendar-check-in')
                        const inputCheckOut = document.getElementById('hidden-calendar-check-out')



                        let options = [{ day: 'numeric' }, { month: 'short' }, { year: 'numeric' }];
                        var dateToday = new Date();
                        let timeZone = 'America/Los_Angeles';

                        var calendar = flatpickr(el, {
                            mode: "range",
                            showMonths: document.body.clientWidth < 750 ? 1 : 2,
                            orientation: "left",
                            dateFormat: 'Y-M-D',
                            altInput: true,
                            time_24hr: true,
                            altFormat: 'Y-M-D',
                            minDate: dateToday,
                            parseDate(dateString, format) {
                                let timezonedDate = new moment.tz(dateString, format, timeZone);

                                return new Date(
                                    timezonedDate.year(),
                                    timezonedDate.month(),
                                    timezonedDate.date(),
                                    timezonedDate.hour(),
                                    timezonedDate.minute(),
                                    timezonedDate.second()
                                );
                            },
                            formatDate(date, format) {
                                return moment.tz([
                                    date.getFullYear(),
                                    date.getMonth(),
                                    date.getDate(),
                                    date.getHours(),
                                    date.getMinutes(),
                                    date.getSeconds()
                                ], timeZone).locale('en-GB').format(format);
                            },
                            onClose: function (selectedDates, dateStr, instance) {
                                if (selectedDates.length == 2) {
                                    let startFormatted = join(selectedDates[0], options, ' ');
                                    let endFormatted = join(selectedDates[1], options, ' ');
                                    text.innerText = startFormatted + " - " + endFormatted;
                                    // interact with selected dates here

                                    inputCheckIn.value = moment(selectedDates[0]).toISOString(true).slice(0, 19).replace('T', ' ');
                                    console.log(inputCheckIn.value)

                                    inputCheckOut.value = moment(selectedDates[1]).toISOString(true).slice(0, 19).replace('T', ' ');
                                }
                            }
                        })

                        let checkInRequest = ("{{ $request->query('checkin') ? $request->query('checkin') : "" }}")
                        let checkOutRequest = ("{{ $request->query('checkout') ? $request->query('checkout') : "" }}")

                        if (checkInRequest === '' || checkOutRequest === '' ) {
                            checkInRequest = new Date();

                            checkOutRequest = new Date().setDate(new Date().getDate() + 3);

                            calendar.selectedDates[0] = new Date();
                            calendar.selectedDates[1] = new Date();

                            let startFormatted = '-'
                            let endFormatted = '-'
                            text.innerText = startFormatted + " - " + endFormatted;

                        }
                        else 
                        {
                            checkInRequest = new Date(checkInRequest)
                            checkOutRequest = new Date(checkOutRequest)

                            console.log(checkInRequest)
                            console.log(checkOutRequest)

                            calendar.selectedDates[0] = checkInRequest;
                            calendar.selectedDates[1] = checkOutRequest;

                            let startFormatted = join(calendar.selectedDates[0], options, ' ');
                            let endFormatted = join(calendar.selectedDates[1], options, ' ');
                            text.innerText = startFormatted + " - " + endFormatted;

                            // interact with selected dates here
                            inputCheckIn.value = calendar.selectedDates[0].toISOString().slice(0, 19).replace('T', ' ');
                            inputCheckOut.value = calendar.selectedDates[1].toISOString().slice(0, 19).replace('T', ' ');
                        }
                    </script>

                    <style>
                        .dayContainer {
                            display: flex;
                            justify-content: left;
                        }
                    </style>

                    <script defer>
                        const peopleButton = document.getElementById('people-button')
                        const peopleInput = document.getElementById('people-input')
                        const peoplePanel = document.getElementById('people-panel')
                        peoplePanel.style.maxHeight = "12rem"
                        peoplePanel.style.opacity = "0"

                        let peoplePanelDisabled = true;
                        peoplePanel.style.opacity = "0"
                        peoplePanel.style.maxHeight = "0px"

                        peopleButton.addEventListener('click', function () {
                            if (peoplePanelDisabled) {
                                peoplePanel.style.opacity = "100"
                                peoplePanel.style.maxHeight = "24rem"
                                peoplePanelDisabled = false
                            } else {
                                peoplePanel.style.opacity = "0"
                                peoplePanel.style.maxHeight = "0px"
                                peoplePanelDisabled = true
                            }
                        });


                        const adult = document.getElementById('adult')
                        const children = document.getElementById('children')
                        const room = document.getElementById('room')
                        const peopleText = document.getElementById('people-text')

                        function SetGuestSearch() {
                            event.preventDefault()
                            peopleText.innerText = `${adult.value} Adult · ${children.value} Children · ${room.value} Room`

                            peoplePanel.style.opacity = "0"
                            peoplePanel.style.maxHeight = "0px"
                            peoplePanelDisabled = true
                            return false;
                        }


                    </script>
                </div>
            </form>



            @if (!$request->query('checkin') || !$request->query('checkout'))
                <div class="mb-2 bg-yellow-500 text-sm text-white rounded-lg p-4" role="alert" tabindex="-1"
                    aria-labelledby="hs-solid-color-warning-label">
                    <span id="hs-solid-color-warning-label" class="font-bold">Warning</span> You haven't selected any Date.
                </div>
            @endif

            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-[1280px] inline-block align-top">
                        <div class="overflow-hidden">
                            <table class="border rounded-sm  divide-y  divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 w-[25%] text-start text-xs font-medium text-white bg-indigo-500 uppercase">
                                            Room type
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 w-[10%] text-start text-xs font-medium text-white bg-indigo-500 uppercase">
                                            Number of Guest
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 w-[15%] text-start text-xs font-medium text-white bg-indigo-800 uppercase">
                                            Price for                                 {{ date_diff( date_create($request->checkin), date_create($request->checkout))->d }} Nights
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-white bg-indigo-500 uppercase">
                                            Your Choice
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 w-[10%]  text-start text-xs font-medium text-white bg-indigo-500 uppercase">
                                            Select amount
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-end text-xs font-medium text-white bg-indigo-500 uppercase">
                                        </th>

                                    </tr>
                                </thead>


                                <tbody class="divide-y divide-gray-800 ">
                                        <form method="GET"
                                            action="{{ Route('cart.checkoutForm', [$rental, ($request->getQueryString() == '') ? 'da' : $request->getQueryString(), (!$request->filled('checkin')) ? 'undefined' :  $request->query('checkin'), (!$request->filled('checkin')) ? 'undefined' : $request->query('checkout')  ])    }} 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                            @csrf
                                            <tr>
                                    @foreach ($roomTypes as $roomType)

                                                <td class="px-6 py-4 whitespace-nowrap   text-gray-800 font-bold border">
                                                    <p class="text-lg cursor-pointer underline text-indigo-600 "
                                                        aria-haspopup="dialog" aria-expanded="false"
                                                        aria-controls="{{ 'roomtype' . '-' . str_replace(' ', '', $roomType->name) }}"
                                                        data-hs-overlay="{{ '#roomtype' . '-' . str_replace(' ', '', $roomType->name) }}">
                                                        {{$roomType->name}}
                                                    </p>
                                                    <p>{{$roomType->bed . " Bed's" }} </p>
                                                    <hr class="my-2">
                                                    <div class="flex flex-wrap w-full gap-2 items-center">

                                                        <div class="flex items-center">
                                                            <div class="w-4  mr-2">
                                                                @svg('fas-house')
                                                            </div>
                                                            <p class="text-sm">{{$roomType->wide}} M²</p>
                                                        </div>
                                                        @foreach ($facilities as $facility)

                                                            <div class="flex items-center gap-2 ">
                                                                @if ($facility->RentalFacilityId->facility == 'Free parking')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('tabler-parking')
                                                                    </div>
                                                                @elseif ($facility->RentalFacilityId->facility == 'Restaurant')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('ionicon-restaurant-sharp')
                                                                    </div>
                                                                @elseif ($facility->RentalFacilityId->facility == 'Pet friendly')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('fas-dog')
                                                                    </div>
                                                                @elseif ($facility->RentalFacilityId->facility == '24-hour front desk')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('tabler-desk')
                                                                    </div>
                                                                @elseif ($facility->RentalFacilityId->facility == 'Fitness center')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('ionicon-fitness-sharp')
                                                                    </div>
                                                                @elseif ($facility->RentalFacilityId->facility == 'Non-smoking rooms')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('tabler-smoking-no')
                                                                    </div>
                                                                @elseif ($facility->RentalFacilityId->facility == 'Airport shuttle')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('tabler-building-airport')
                                                                    </div>
                                                                @elseif ($facility->RentalFacilityId->facility == 'Family rooms')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('eva-checkmark-circle-2-outline')
                                                                    </div>
                                                                @elseif ($facility->RentalFacilityId->facility == 'Spa')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('fas-spa')
                                                                    </div>
                                                                @elseif ($facility->RentalFacilityId->facility == 'Electric vehicle charging station')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('fas-car')
                                                                    </div>
                                                                @elseif ($facility->RentalFacilityId->facility == 'Wheelchair accessible')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('fas-wheelchair')
                                                                    </div>
                                                                @elseif ($facility->RentalFacilityId->facility == 'Swimming pool')
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('fas-swimming-pool')
                                                                    </div>
                                                                @else
                                                                    <div class="w-4 mr-1 text-black">
                                                                        @svg('eva-checkmark-circle-2-outline')
                                                                    </div>
                                                                @endif
                                                                <p class="text-sm">
                                                                    {{$facility->RentalFacilityId->facility}}
                                                                </p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <hr class="my-2">

                                                    <div class="flex flex-wrap w-full gap-2 items-center">
                                                        @foreach ($roomFacilities as $roomFacility)
                                                            <div class="flex items-center ">
                                                                <div class="w-4 mr-1 text-green-600">
                                                                    @svg('eva-checkmark-circle-2-outline')
                                                                </div>
                                                                <p class="text-sm">
                                                                    {{$roomFacility->RoomFacilityId->rental_facility}}
                                                                </p>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </td>
                                                <td class="px-6 py-4 text-sm  text-gray-800 border">
                                                    <div class="flex w-full gap items-center">
                                                        <div class="flex">
                                                            @foreach (range(1, $roomType->adult) as $i)
                                                                <div class="w-5">
                                                                    {{ svg('elusive-adult') }}
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        +
                                                        <div class="flex">
                                                            @foreach (range(1, $roomType->child) as $i)
                                                                <div class="w-3">
                                                                    {{ svg('fas-child') }}
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap  text-gray-800 text-lg font-bold border">
                                                    {{ date_diff( date_create($request->checkin), date_create($request->checkout))->d * $roomType->price }}
                                                    USD
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-start text-sm font-medium">
                                                    <div class="flex flex-col gap-2">
                                                        @foreach ($roomServices as $service)
                                                            @if ($service->cost > 0)
                                                                <div class="flex items-center">
                                                                    <x-checkbox class="mr-4" name="{{ 'Service_' . $service->ServiceId->id . '_' . $roomType->id }}" value="{{ $service->id }}" />
                                                                    <div>
                                                                        <span
                                                                            class="text-md">{{$service->ServiceId->rental_service}}</span>
                                                                        <br>
                                                                        <span class="text-sm text-gray-600">{{$service->cost}}
                                                                            USD</span>
                                                                    </div>
                                                                </div>
                                                            @elseif ($service->cost == 0)
                                                                <div class="flex items-center">
                                                                    <div class="mr-4">
                                                                        @if ($service->ServiceId->rental_service == 'Wifi')
                                                                            <div class="w-4 mr-1 text-green-600">
                                                                                @svg('bi-wifi')
                                                                            </div>
                                                                        @elseif ($service->ServiceId->rental_service == 'Breakfast')
                                                                            <div class="w-4 mr-1 text-green-600">
                                                                                @svg('ionicon-restaurant-sharp')
                                                                            </div>
                                                                        @elseif ($service->ServiceId->rental_service == 'Room service')

                                                                            <div class="w-4 mr-1 text-green-600">
                                                                                @svg('gmdi-cleaning-services-o')
                                                                            </div>
                                                                        @else
                                                                            <div class=" w-4 mr-1 text-green-600">
                                                                                @svg('eva-checkmark-circle-2-outline')
                                                                            </div>
                                                                        @endif

                                                                    </div>

                                                                    <div>
                                                                        <span
                                                                            class="text-md">{{$service->ServiceId->rental_service}}</span>
                                                                        <br>
                                                                        <span
                                                                            class="text-sm text-white bg-green-600 px-2">Free</span>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <p class="bg-red-500">ERROR</p>
                                                            @endif
                                                        @endforeach
                                                    </div>

                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap  text-gray-800 text-lg font-bold border">

                                                    @php
                                                        $outOfStock = false;
                                                        foreach ($roomTypesAmountAvailable as $room) {
                                                            if ($room['room_id'] == $roomType->id && $room['amount'] == 0) {
                                                                $outOfStock = true;
                                                            }
                                                        }
                                                    @endphp

                                                    @if ($outOfStock)
                                                        <p class="bg-red-500 text-white px-3">Out Of Stock</p>
                                                    @else
                                                        <select name="{{ str_replace(' ', '', $roomType->name) }}RoomAmount" id="hs-select-label"
                                                            class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                            <option selected="0">0</option>
                                                            @foreach ($roomTypesAmountAvailable as $room)
                                                                @if ($room['room_id'] == $roomType->id && $room['amount'] != 0)
                                                                    @foreach (range(1, $room['amount']) as $i)
                                                                        <option value="{{ $i }}">{{ $i }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    @endif


                                                </td>
                                                <td class="h-full">
                                                    @if ($loop->index === 0)
                                                        
                                                    <div class="flex py-3 justify-center items-center">
                                                        <x-button class="bg-indigo-800 text-center">Book now</x-button>
                                                    </div>
                                                    @endif

                                                </td>
                                    @endforeach

                                            </tr>
                                        </form>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-original.guest-navbar>

</x-guest-layout>