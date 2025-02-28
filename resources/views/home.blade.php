<x-guest-layout>

    <x-original.guest-navbar>
        <div class="flex bg-indigo-600 -z-20 items-center justify-center">
            <div class="bg-indigo-600 max-w-[80rem]  h-80 w-[100vw] ">
                <div class="flex h-full max-2xl:items-center flex-col justify-center ">
                    <h1 class="text-white  font-bold max-sm:text-2xl text-4xl">Your next adventure
                        starts
                        here!
                    </h1>
                    <h2 class="text-gray-200 max-sm:text-lg text-2xl">discover, book, and explore
                        effortlessly...
                    </h2>

                </div>
            </div>
        </div>


        <form action="{{ Route('show.search') }}">
            <div class=" w-[100vw] justify-center  -translate-y-8  z-50 flex xl:px-[20px] px-[4vw] max-xl:items-center">
                <div
                    class="flex  max-w-[80rem] max-xl:flex-col bg-yellow-500 p-1 gap-1 rounded-l-md rounded-r-md w-full">
                    <div class="w-full bg-white rounded-l-md  flex items-center h-12">
                        <div class="pl-2 flex justify-center items-center">
                            <div class="w-6 text-slate-600">
                                @svg('zondicon-location')
                            </div>
                        </div>
                        <div id="locationField" style="width: 90%;">
                            <x-input id="autocomplete" name="location" placeholder="Location..." type="text"
                                value="Indonesia"
                                class="no-focus text-sm outline-none w-full h-full border-none shadow-none rounded-none" />

                            <!-- Address Input -->
                            <input type="text" id="street_address" name="street_address" class="hidden">
                            <input type=" text" id="route" name="route" class="hidden">
                            <input type="text" id="country" value="Indonesia" name="country" class="hidden">
                            <input type="text" id="administrative_area_level_1" name="administrative_area_level_1"
                                class="hidden">
                            <input type="text" id="administrative_area_level_2" name="administrative_area_level_2"
                                class="hidden">
                            <input type="text" id="administrative_area_level_3" name="administrative_area_level_3"
                                class="hidden">
                            <input type="text" id="administrative_area_level_4" name="administrative_area_level_4"
                                class="hidden">
                            <input type="text" id="administrative_area_level_5" name="administrative_area_level_5"
                                class="hidden">
                            <input type="text" id="administrative_area_level_6" name="administrative_area_level_6"
                                class="hidden">
                            <input type="text" id="administrative_area_level_7" name="administrative_area_level_7"
                                class="hidden">
                            <input type="text" id="locality" name="locality" class="hidden">
                            <input type="text" id="postal_code" name="postal_code" class="hidden">
                            <input type="text" id="latitude" name="latitude" class="hidden">
                            <input type="text" id="longitude" name="longitude" class="hidden">
                            <input type="text" id="full_address" name="full_address" class="hidden">
                        </div>
                        <script
                            src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_API')}}&libraries=places&callback=initAutocomplete"
                            defer async></script>
                        <script>
                            var placeSearch, autocomplete, geocoder;

                            var elem = null;

                            function selectFirstPredictionOnEnter(input) {
                                // store the original event binding function
                                var _addEventListener = (input.addEventListener) ? input.addEventListener : input.attachEvent;

                                function addEventListenerWrapper(type, listener) {
                                    // Simulate a 'down arrow' keypress on hitting 'return' when no pac suggestion is selected,
                                    // and then trigger the original listener.

                                    if (type == 'keydown') {
                                        var orig_listener = listener;

                                        listener = function (event) {
                                            var suggestion_selected = $(".pac-item-selected").length > 0;

                                            if (event.which == 13 && !suggestion_selected) {
                                                var simulated_downarrow = $.Event("keydown", {
                                                    keyCode: 40,
                                                    which: 40
                                                });

                                                orig_listener.apply(input, [simulated_downarrow]);
                                            }

                                            orig_listener.apply(input, [event]);
                                        };
                                    }

                                    _addEventListener.apply(input, [type, listener]);
                                }

                                if (input.addEventListener)
                                    input.addEventListener = addEventListenerWrapper;
                                else if (input.attachEvent)
                                    input.attachEvent = addEventListenerWrapper;
                            }

                            function updateHTML(elmId, finalValue) {

                                elem = document.getElementById(elmId);
                                if (typeof elem !== 'undefined' && elem !== null) {
                                    document.getElementById(elmId).value = finalValue;
                                    console.log(document.getElementById(elmId).value);
                                }
                                elem = null;
                            }

                            function initAutocomplete() {
                                geocoder = new google.maps.Geocoder();
                                autocomplete = new google.maps.places.Autocomplete(
                                    (document.getElementById('autocomplete'))/*,
          {types: ['(cities)']}*/);

                                autocomplete.addListener('place_changed', fillInAddress);
                                document.getElementById('autocomplete').addEventListener('focusout', fillInAddress);
                            }

                            function codeAddress(address) {
                                geocoder.geocode({ 'address': address }, function (results, status) {
                                    if (status == 'OK') {
                                        console.log(address)
                                        var filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("administrative_area_level_1");
                                        });
                                        updateHTML('administrative_area_level_1', filtered_array.length ? filtered_array[0].long_name : "");

                                        console.log(filtered_array)
                                        console.log(results)
                                        filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("administrative_area_level_2");
                                        });
                                        updateHTML('administrative_area_level_2', filtered_array.length ? filtered_array[0].long_name : "");


                                        filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("administrative_area_level_3");
                                        });
                                        updateHTML('administrative_area_level_3', filtered_array.length ? filtered_array[0].long_name : "");


                                        filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("administrative_area_level_4");
                                        });
                                        updateHTML('administrative_area_level_4', filtered_array.length ? filtered_array[0].long_name : "");

                                        filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("administrative_area_level_5");
                                        });
                                        updateHTML('administrative_area_level_5', filtered_array.length ? filtered_array[0].long_name : "");

                                        filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("administrative_area_level_6");
                                        });
                                        updateHTML('administrative_area_level_6', filtered_array.length ? filtered_array[0].long_name : "");

                                        filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("administrative_area_level_7");
                                        });
                                        updateHTML('administrative_area_level_7', filtered_array.length ? filtered_array[0].long_name : "");


                                        filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("street_address");
                                        });
                                        updateHTML('street_address', filtered_array.length ? filtered_array[0].long_name : "");


                                        filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("route");
                                        });
                                        updateHTML('route', filtered_array.length ? filtered_array[0].long_name : "");


                                        filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("country");
                                        });
                                        updateHTML('country', filtered_array.length ? filtered_array[0].long_name : "");

                                        filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("locality");
                                        });
                                        updateHTML('locality', filtered_array.length ? filtered_array[0].long_name : "");

                                        filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("postal_code");
                                        });
                                        updateHTML('postal_code', filtered_array.length ? filtered_array[0].long_name : "");

                                        updateHTML('full_address', results[0].formatted_address)

                                        let latitude = results[0].geometry.location.lat()
                                        let longitude = results[0].geometry.location.lng()

                                        updateHTML('latitude', latitude);
                                        updateHTML('longitude', longitude);
                                    } else {
                                        alert('Geocode was not successful for the following reason: ' + status);
                                    }
                                });
                            }

                            function fillInAddress() {
                                codeAddress(document.getElementById('autocomplete').value);
                            }

                        </script>

                    </div>
                    <div class="w-[60%] max-xl:w-full relative bg-white flex items-center h-12">
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
                            <input id="hidden-calendar-check-out" class="invisible hidden" type="text" name="checkout"
                                id="calendar">
                        </div>
                    </div>

                    <div class="w-[60%] z-40 relative cursor-pointer max-xl:w-full bg-white   h-12">
                        <div id="people-button" class="flex items-center h-full">
                            <div class="pl-2 flex justify-center items-center">
                                <div class="w-6 text-slate-600">
                                    {{ svg('elusive-adult') }}
                                </div>
                            </div>
                            <div id="people-text"
                                class="cursor-pointer flex items-center ml-2 text-sm w-full h-full border-none shadow-none rounded-none">
                                2 Adult · 1 Children · 1 Room
                            </div>
                        </div>

                        <div id="people-panel"
                            class="w-80 z-50  transition-all overflow-hidden p-2 gap-2 translate-y-12  rounded-lg flex-col flex justify-center bg-white shadow-2xl  absolute top-0 left-0">
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
                                            aria-roledescription="Number field" value="2" data-hs-input-number-input="">
                                    </div>
                                    <div class="flex justify-end items-center gap-x-1.5">
                                        <button type="button"
                                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                            tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                            </svg>
                                        </button>
                                        <button type="button"
                                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                            tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                                <path d="M12 5v14"></path>
                                            </svg>
                                        </button>

                                    </div>
                                </div>
                            </div>


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
                                            aria-roledescription="Number field" value="1" data-hs-input-number-input="">
                                    </div>
                                    <div class="flex justify-end items-center gap-x-1.5">
                                        <button type="button"
                                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                            tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                            </svg>
                                        </button>
                                        <button type="button"
                                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                            tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                            aria-roledescription="Number field" value="1" id="room" name="room"
                                            data-hs-input-number-input="">
                                    </div>
                                    <div class="flex justify-end items-center gap-x-1.5">
                                        <button type="button"
                                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                            tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                            </svg>
                                        </button>
                                        <button type="button"
                                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                            tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

                            <!-- End Input Number -->
                        </div>
                    </div>
                    <div class=" ">
                        <x-button class="w-full h-full rounded-r-md rounded-none bg-indigo-800">Search</x-button>
                    </div>
                </div>
            </div>
        </form>

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
                        inputCheckOut.value = moment(selectedDates[1]).toISOString(true).slice(0, 19).replace('T', ' ');
                    }
                }
            });

            let checkInRequest = new Date();

            let checkOutRequest = new Date();
            checkOutRequest.setDate(checkOutRequest.getDate() + 3);


            calendar.selectedDates[0] = checkInRequest;
            calendar.selectedDates[1] = checkOutRequest;

            let startFormatted = join(calendar.selectedDates[0], options, ' ');
            let endFormatted = join(calendar.selectedDates[1], options, ' ');
            text.innerText = startFormatted + " - " + endFormatted;

            // interact with selected dates here
            inputCheckIn.value = calendar.selectedDates[0].toISOString().slice(0, 19).replace('T', ' ');
            inputCheckOut.value = calendar.selectedDates[1].toISOString().slice(0, 19).replace('T', ' ');

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

        <x-original.membership />

        <hr />
        <h4 class="text-center my-4 text-2xl font-bold">Discover</h4>

        <hr />
        <h4 class="text-center my-4 text-xl z-0 font-bold">Newest Property</h4>
        <!-- Slider main container -->
        <div class="swiper swiper-2 z-0 max-w-[80rem] w-[100vw]" style="overflow: visible">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper swiper-wrapper-2">
                <!-- Slides -->
                @foreach ($newest as $result)
                    <div class="swiper-slide" style="height:528px;">
                        <!-- Card -->
                        <div class="group flex w-full flex-col h-full bg-white border border-gray-200 shadow-sm rounded-xl">
                            <div class="h-64 flex flex-col justify-center items-center bg-gray-200 rounded-t-xl">
                                <img class="w-full rounded-t-xl h-full"
                                    src="{{ asset('storage/rental_images/' . DB::table('rental_images')->where('rental_id', '=', $result->id)->first('src')->src) }}"
                                    alt="{{ $result->id . ' Preview' }}">
                            </div>

                            <div class="p-4 md:p-6">
                                <span class="block mb-1 text-left text-xs font-semibold uppercase text-gray-500">
                                    {{ $result->PropertyTypeId->type }}
                                </span>
                                <h3 class="text-xl text-left font-semibold text-gray-800">
                                    {{ $result->name }}
                                </h3>
                                <hr class="my-4" />
                                <div class="h-28  overflow-hidden">
                                    <p class="text-left text-gray-500 break-words ">
                                        {{ $result->description }}
                                    </p>
                                </div>

                            </div>
                            <div class="mt-auto flex border-t border-gray-200 divide-x divide-gray-200">
                                <a class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-es-xl bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                    href="{{ Route('show.rental', $result->id) }}">
                                    View Property
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- If we need pagination -->
            <div class="b-4 swiper-pagination swiper-pagination-2"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button-prev-2 transition-all"></div>
            <div class="swiper-button-next swiper-button-next-2 transition-all"></div>
        </div>
        <hr />
        <h4 class="text-center my-4 text-xl font-bold">Countries</h4>
        <!-- Slider main container -->
        <div class="swiper swiper-1 max-w-[80rem] w-[100vw]" style="height: 258px; overflow: visible;">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper swiper-wrapper-1 ">
                <!-- Slides -->
                @foreach ($countries as $result)
                    <div class="swiper-slide">
                        <form style="height: 258px;" action=" {{Route('show.search') }}">
                            <button
                                class="bg-black w-full text-white flex justify-center items-start flex-col h-full rounded-lg">
                                <p class="translate-x-4 text-bold text-xl">{{ $result->country }}</p>
                                <p class="translate-x-4 opacity-80">
                                    <span style="opacity: 100;">Number of Listing :
                                    </span>{{ DB::table("rentals")->where('country', '=', $result->country)->count() }}
                                </p>
                                <input type="text" id="country" value="{{ $result->country  }}" name="country"
                                    class="hidden">
                                <input type="text" id="location" value="{{ $result->country  }}" name="location"
                                    class="hidden">
                                <input id="hidden-calendar-check-in" value="{{ Carbon\Carbon::now() }}"
                                    class="invisible hidden" type="text" name="checkin" id="calendar"> <input
                                    id="hidden-calendar-check-out"
                                    value="{{ Carbon\Carbon::now()->addUTCDay()->addUTCDay()->addUTCDay() }}"
                                    class="invisible hidden" type="text" name="checkout" id="calendar">
                                <input type="text" class="hidden" value="0" name="room" id="">
                                <input type="text" class="hidden" value="0" name="adult" id="">
                                <input type="text" class="hidden" value="0" name="children" id="">
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- If we need pagination -->
            <div class="b-4 swiper-pagination swiper-pagination-1"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button-prev-1 transition-all"></div>
            <div class="swiper-button-next swiper-button-next-1 transition-all"></div>
        </div>
        <hr class="mt-4" />
        <h4 class="text-center my-4 text-xl font-bold">Selections</h4>
        <!-- Slider main container -->
        <div class="swiper swiper-0 max-w-[80rem]  w-[100vw]" style="overflow: visible">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper swiper-wrapper-0">
                <!-- Slides -->
                @foreach ($random as $result)
                    <div class="swiper-slide" style="height:528px;">
                        <!-- Card -->
                        <div class="group flex w-full flex-col h-full bg-white border border-gray-200 shadow-sm rounded-xl">
                            <div class="h-64 flex flex-col justify-center items-center bg-gray-200 rounded-t-xl">
                                <img class="w-full rounded-t-xl h-full "
                                    src="{{ asset('storage/rental_images/' . DB::table('rental_images')->where('rental_id', '=', $result->id)->first('src')->src) }}"
                                    alt="{{ $result->id . ' Preview' }}">
                            </div>
                            <div class=" p-4 md:p-6">
                                <span class="block mb-1 text-left text-xs font-semibold uppercase text-gray-500">
                                    {{ $result->PropertyTypeId->type }}
                                </span>
                                <h3 class="text-xl text-left font-semibold text-gray-800">
                                    {{ $result->name }}
                                </h3>
                                <hr class="my-4" />
                                <div class="h-28  overflow-hidden">
                                    <p class="text-left text-gray-500 break-words ">
                                        {{ $result->description }}
                                    </p>
                                </div>

                            </div>
                            <div class="mt-auto flex border-t border-gray-200 divide-x divide-gray-200">
                                <a class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-es-xl bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                    href="{{ Route('show.rental', $result->id) }}">
                                    View Property
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- If we need pagination -->
            <div class="b-4 swiper-pagination swiper-pagination-0"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button-prev-0 transition-all"></div>
            <div class="swiper-button-next swiper-button-next-0 transition-all"></div>
        </div>
        <hr />

        <style>
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
                translate: 30px;
            }


            .swiper-button-next {
                translate: 40px;
            }

            .swiper-button-prev:hover {
                translate: -30px;
            }

            .swiper-button-prev {
                translate: -40px;

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
            const swiper = document.querySelectorAll(".swiper");
            const pagination = document.querySelectorAll(".swiper-pagination");
            const prev = document.querySelectorAll(".swiper-button-prev");
            const next = document.querySelectorAll(".swiper-button-next");

            for (let i = 0; i < 3; i++) {
                swiper[i].classList.add("swiper-" + i);
                pagination[i].classList.add("swiper-pagination-" + i);
                prev[i].classList.add("swiper-prev-" + i);
                next[i].classList.add("swiper-next-" + i);
                const swiperClass = new Swiper(".swiper-" + i, {
                    slidesPerView: 3,
                    spaceBetween: 24,
                    pagination: {
                        el: ".swiper-pagination-" + i,
                        clickable: true
                    },
                    navigation: {
                        nextEl: ".swiper-button-next-" + i,
                        prevEl: ".swiper-button-prev-" + i
                    },
                    watchSlidesProgress: true
                });
            }
        </script>

    </x-original.guest-navbar>
</x-guest-layout>