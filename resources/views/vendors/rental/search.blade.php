<x-guest-layout>

    <x-original.guest-navbar id="guest-navbar">
        <div class="flex bg-indigo-600 -z-20 items-center justify-center">
            <div class="bg-indigo-600 max-w-[80rem]  h-40 w-[100vw] ">
                <div class="flex h-full max-2xl:items-center flex-col justify-center ">

                </div>
            </div>
        </div>
        <form action="{{ Route('show.search', ['page' => 1]) }}) }}">
            <div class=" w-[100vw] justify-center  -translate-y-8  z-10 flex xl:px-[20px] px-[4vw] max-xl:items-center">
                <div
                    class="flex  max-w-[80rem] max-xl:flex-col bg-yellow-500 p-1 gap-1 rounded-l-md rounded-r-md w-full">
                    <div class="w-full bg-white rounded-l-md  flex items-center h-12">
                        <div class="pl-2 flex justify-center items-center">
                            <div class="w-6 text-slate-600">
                                @svg('zondicon-location')
                            </div>
                        </div>
                        <div id="locationField" style="width: 90%;">
                            <x-input name="location" id="autocomplete" placeholder="Location..." type="text" value="{{ $request->location }}"
                                class="no-focus text-sm outline-none w-full h-full border-none shadow-none rounded-none" />


                            <!-- Address Input -->
                            <input type="text" id="street_address" name="street_address" value="{{ $request->street_address }}" class="hidden">
                            <input type="text" id="route" name="route" value="{{ $request->route }}" class="hidden">
                            <input type="text" id="country" name="country" value="{{ $request->country }}" class="hidden">
                            <input type="text" id="administrative_area_level_1" value="{{ $request->administrative_area_level_1 }}" name="administrative_area_level_1"
                                class="hidden">
                            <input type="text" id="administrative_area_level_2" value="{{ $request->administrative_area_level_2 }}" name="administrative_area_level_2"
                                class="hidden">
                            <input type="text" id="administrative_area_level_3" value="{{ $request->administrative_area_level_3 }}" name="administrative_area_level_3"
                                class="hidden">
                            <input type="text" id="administrative_area_level_4" value="{{ $request->administrative_area_level_4 }}" name="administrative_area_level_4"
                                class="hidden">
                            <input type="text" id="administrative_area_level_5" value="{{ $request->administrative_area_level_5 }}" name="administrative_area_level_5"
                                class="hidden">
                            <input type="text" id="administrative_area_level_6" value="{{ $request->administrative_area_level_6 }}" name="administrative_area_level_6"
                                class="hidden">
                            <input type="text" id="administrative_area_level_7" value="{{ $request->administrative_area_level_7 }}" name="administrative_area_level_7"
                                class="hidden">
                            <input type="text" id="locality" name="locality" value="{{ $request->locality }}" class="hidden">
                            <input type="text" id="postal_code" name="postal_code" value="{{ $request->postal_code }}" class="hidden">
                            <input type="text" id="latitude" name="latitude" value="{{ $request->latitude }}" class="hidden">
                            <input type="text" id="longitude" name="longitude" value="{{ $request->longitude }}" class="hidden">
                            <input type="text" id="full_address" name="full_address" value="{{ $request->full_address }}" class="hidden">
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

                                    if(type == 'keydown') {
                                        var orig_listener = listener;

                                        listener = function(event) {
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
                    <div  class="w-[60%] max-xl:w-full bg-white flex relative items-center h-12">
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
                            <input id="hidden-calendar-time-zone" class="invisible hidden" type="text" name="timezone"
                                id="calendar">
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
                                {{ $request->adult }} Adult · {{ $request->children }} Children · {{ $request->room }} Room
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
                                            aria-roledescription="Number field" value="{{ $request->adult }}" data-hs-input-number-input="">
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
                                            aria-roledescription="Number field" value="{{ $request->children }}" data-hs-input-number-input="">
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
                                            aria-roledescription="Number field" value="{{ $request->room }}" id="room" name="room"
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
                                    @if (!empty($pet))
                                    <input id="pet" name="pet" type="checkbox"
                                    class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none  dark:"
                                    id="hs-checkbox-in-form" checked>       
                                    @else
                                    <input id="pet" name="pet" type="checkbox"
                                    class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none  dark:"
                                    id="hs-checkbox-in-form">
                                    @endif
 
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



        <script defer>
            window.addEventListener("load", function (event) {
                document.querySelector('[data-drawer-show="drawer-example"]').click();
            });
        </script>
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

            let checkInRequest = ("{{ $request->checkin }}");
            checkInRequest = new Date(checkInRequest);

            let checkOutRequest = ("{{ $request->checkout }}");
            checkOutRequest = new Date(checkOutRequest);

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



        <div id="drawer-example"
            class="fixed  left-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-scroll transition-transform -translate-x-full bg-white dark:bg-gray-800"
            tabindex="-1" aria-labelledby="drawer-label">
            <div class="mt-[4.8rem]"></div>
            <h5 id="drawer-label"
                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
                Apply filters
            </h5>
            <button type="button" data-drawer-dismiss="drawer-example" aria-controls="drawer-example"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>

            <div class="flex flex-col justify-between flex-1">
                <div class="space-y-6">
                    <!-- Categories -->
                    <div class="space-y-2">
                        <h6 class="text-base font-medium text-black dark:text-white">
                            Facilities
                        </h6>
                        @foreach ($facilities as $facility)
                            <div class="flex items-center">
                                <input id="{{ $facility->facility }}" type="checkbox"
                                    name="{{ $facility->facility }}" value="{{ $facility->facility }}"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                <label for="{{ $facility->facility }}"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ $facility->facility }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2">
                        <h6 class="text-base font-medium text-black dark:text-white">
                            Service
                        </h6>
                        @foreach ($services as $service)
                            <div class="flex items-center">
                                <input id="{{ $service->rental_service }}" type="checkbox"
                                    name="{{ $service->rental_service }}" value="{{ $service->rental_service }}"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                <label for="{{ $service->rental_service }}"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ $service->rental_service }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2">
                        <h6 class="text-base font-medium text-black dark:text-white">
                            Room Facility
                        </h6>
                        @foreach ($roomFacilities as $roomFacility)
                            <div class="flex items-center">
                                <input id="{{ $roomFacility->rental_facility }}" type="checkbox"
                                    name="{{ $roomFacility->rental_facility }}" value="{{ $roomFacility->rental_facility }}"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                <label for="{{ $roomFacility->rental_facility }}"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ $roomFacility->rental_facility }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Prices -->
                    <div>
                        <h6 class="text-base mb-16 mt-4 font-medium text-black dark:text-white">
                            USD (Per Night)
                        </h6>
                        <div class="flex justify-center">

                            <div class="w-[90%]">
                                <div id="hs-pass-values-to-inputs" class="--prevent-on-load-init" data-hs-range-slider='{
                          "start": [{{ '0' }}, {{ $roomTypeHighestPrice }}],
                          "range": {
                            "min": {{ '0' }},
                            "max": {{ $roomTypeHighestPrice }}
                          },
                          "connect": true,
                          "tooltips": true,
                          "formatter": "integer",
                          "cssClasses": {
                            "target": "relative h-1 rounded-full bg-gray-100",
                            "base": "w-full h-full relative z-1",
                            "origin": "absolute top-0 end-0 w-full h-full origin-[0_0] rounded-full",
                            "handle": "absolute top-1/2 end-0 w-[1.125rem] h-[1.125rem] bg-white border-4 border-blue-600 rounded-full cursor-pointer -translate-y-1/4",
                            "connects": "relative z-0 w-full h-full rounded-full overflow-hidden",
                            "connect": "absolute top-0 end-0 z-1 w-full h-full bg-blue-600 origin-[0_0]",
                            "touchArea": "absolute -top-1 -bottom-1 -start-1 -end-1",
                            "tooltip": "bg-white border border-gray-200 text-sm text-gray-800 py-1 px-2 rounded-lg mb-3 absolute bottom-full start-2/4 -translate-x-2/4"
                          }
                        }'>

                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row space-x-4 mt-5">
                            <div class="basis-1/2">
                                <label for="hs-pass-values-to-inputs-min-target"
                                    class="block text-sm font-medium mb-2">Min price:</label>
                                <input id="hs-pass-values-to-inputs-min-target"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                    type="number" name="min_price" value="0">
                            </div>
                            <div class="basis-1/2">
                                <label for="hs-pass-values-to-inputs-max-target"
                                    class="block text-sm font-medium mb-2">Max price:</label>
                                <input id="hs-pass-values-to-inputs-max-target"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                    type="number" name="max_price" value="{{ $roomTypeHighestPrice }}">
                            </div>
                        </div>
                    </div>
                    <script>
                        window.addEventListener('load', () => {
                            (function () {
                                const range = document.querySelector('#hs-pass-values-to-inputs');
                                const rangeInstance = new HSRangeSlider(range);
                                const min = document.querySelector('#hs-pass-values-to-inputs-min-target');
                                const max = document.querySelector('#hs-pass-values-to-inputs-max-target');

                                range.noUiSlider.on('update', (values) => {
                                    min.value = rangeInstance.formattedValue[0];
                                    max.value = rangeInstance.formattedValue[1];
                                });
                                min.addEventListener('input', _.debounce((evt) => rangeInstance.el.noUiSlider.set([evt.target.value, max.value]), 200));
                                max.addEventListener('input', _.debounce((evt) => rangeInstance.el.noUiSlider.set([min.value, evt.target.value]), 200));
                            })();
                        });
                    </script>
                    @if (false)
                    <!-- Rating (DISCONTINUED) -->
                    <div class="space-y-2">
                        <h6 class="text-base font-medium text-black dark:text-white">
                            Rating
                        </h6>

                        <div class="flex items-center">
                            <input id="one-star" type="radio" value="" name="rating"
                                class="w-4 h-4 bg-gray-100 border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="one-star" class="flex font-bold items-center ml-3">
                                No Filter
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="five-stars" type="radio" value="" name="rating"
                                class="w-4 h-4 bg-gray-100 border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="five-stars" class="flex items-center ml-2">
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Second star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Third star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fourth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fifth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="four-stars" type="radio" value="" name="rating"
                                class="w-4 h-4 bg-gray-100 border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="four-stars" class="flex items-center ml-2">
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Second star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Third star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fourth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fifth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="three-stars" type="radio" value="" name="rating" checked
                                class="w-4 h-4 bg-gray-100 border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="three-stars" class="flex items-center ml-2">
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Second star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Third star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fourth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fifth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="two-stars" type="radio" value="" name="rating"
                                class="w-4 h-4 bg-gray-100 border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="two-stars" class="flex items-center ml-2">
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Second star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Third star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fourth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fifth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="one-star" type="radio" value="" name="rating"
                                class="w-4 h-4 bg-gray-100 border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="one-star" class="flex items-center ml-2">
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Second star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Third star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fourth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Fifth star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </label>
                        </div>

                    </div>
                    @endif

                </div>

                <div class=" flex justify-center w-full pb-4 mt-6 space-x-4 md:px-4 ">
                    <button type="submit"
                        class="w-full px-5 py-2 text-sm font-medium text-center text-white rounded-lg bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-primary-700 dark:hover:bg-primary-800 dark:focus:ring-primary-800">
                        Apply filters
                    </button>
                    <button type="reset"
                        class="w-full px-5 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-indigo-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Clear all
                    </button>
                </div>
            </div>
        </div>
        <!-- Card Blog -->
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 -mt-8 mx-auto">
            <!-- Breadcrumb -->
            <ol class="mb-3 flex items-center whitespace-nowrap">

                <li class="flex items-center text-sm text-gray-800 dark:text-neutral-400">
                    Listings

                </li>
                @if ( filled($request->country))
                <li class="text-sm flex items-center font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" width="16"
                    height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                    {{ $request->country }}
                </li>
                @endif
                @if ( filled($request->administrative_area_level_1))
                <li class="text-sm flex items-center font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" width="16"
                    height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                    {{ $request->administrative_area_level_1 }}
                </li>
                @endif
                @if ( filled($request->administrative_area_level_2))
                <li class="text-sm flex items-center font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" width="16"
                    height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                    {{ $request->administrative_area_level_2 }}
                </li>
                @endif
                @if ( filled($request->administrative_area_level_3))
                <li class="text-sm flex items-center font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" width="16"
                    height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                    {{ $request->administrative_area_level_3 }}
                </li>
                @endif
                @if ( filled($request->administrative_area_level_4))
                <li class="text-sm flex items-center font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" width="16"
                    height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                    {{ $request->administrative_area_level_4 }}
                </li>
                @endif
                @if ( filled($request->administrative_area_level_5))
                <li class="text-sm flex items-center font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" width="16"
                    height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                    {{ $request->administrative_area_level_5 }}
                </li>
                @endif
                @if ( filled($request->administrative_area_level_6))
                <li class="text-sm flex items-center font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" width="16"
                    height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                    {{ $request->administrative_area_level_6 }}
                </li>
                @endif
                @if ( filled($request->administrative_area_level_7))
                <li class="text-sm flex items-center font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" width="16"
                    height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                    {{ $request->administrative_area_level_7 }}
                </li>
                @endif
                @if ( filled($request->locality))
                <li class="text-sm flex items-center font-semibold text-gray-800 truncate dark:text-neutral-400" aria-current="page">
                    <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" width="16"
                    height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                    {{ $request->locality }}
                </li>
                @endif

                
            </ol>
        </form>

            <!-- End Breadcrumb -->
            @if ($rentals->count() === 0)
            <h1 class="text-black  font-bold max-sm:text-1xl text-2xl">No Properties Found
                
            @else
            <h1 class="text-black  font-bold max-sm:text-1xl text-2xl">Location: {{ $rentals->count() }} Found

            @endif
            </h1>
            <!-- drawer init and toggle -->
            <div class="flex justify-start mt-4">
                <button
                    class="text-white flex gap-2 items-center bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                    type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example"
                    aria-controls="drawer-example">
                    <div class="w-3 text-white">
                        @svg('fas-filter')
                    </div>
                    <div class="border-r h-full mr-2 ml-1 border-indigo-300"></div>
                    Filter
                </button>
            </div>

            <!-- Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 ">

                @foreach ($rentals as $rental)
                       <!-- Card -->
                       <div class="group flex flex-col h-full bg-white border border-gray-200 shadow-sm rounded-xl">
                        <div class="h-64 flex flex-col justify-center items-center bg-gray-200 rounded-t-xl">
                            <img class="w-full rounded-t-xl h-full object-cover"
                                src="{{ asset('storage/rental_images/' . DB::table('rental_images')->where('rental_id', '=', $rental->id)->first('src')->src) }}"
                                alt="{{ $rental->id . ' Preview' }}">
                        </div>
                        @php
                            $roomtype = DB::table('room_types')->
                                        where('rental_id', '=',$rental->id)->
                                        orderBy('price', 'desc')->first('*');
                        @endphp
                        <div class="p-4 md:p-6">
                            <span class="block mb-1 text-xs font-semibold uppercase text-gray-500">
                                {{ $rental->PropertyTypeId->type }}
                            </span>
                            <h3 class="text-xl font-semibold text-gray-800">
                                {{ $rental->name }}
                            </h3>
                            <p class="mt-3 text-gray-500">
                                {{ $rental->description }}
                            </p>
                            <hr class="my-4" />
                            <span class="block mb-1 text-xs font-semibold  text-gray-500">
                                {{ date_diff( date_create($request->checkin), date_create($request->checkout))->d }} Nights
                                @if ( $request->adult &&  $request->adult > 0 )
                                    {{ '• ' . $request->adult  }} Adult
                                @endif
                                @if ( $request->children &&  $request->children > 0 )
                                    {{ '• ' . $request->children  }} Child
                                @endif
                            </span>
                            <h3 class="text-xl font-semibold text-gray-800">
                                {{ 'USD ' . $roomtype->price  }}
                            </h3>
                            <p class="mt-3 text-gray-500">
                                {{ $roomtype->name }}
                            </p>
                        </div>
                        <div class="mt-auto flex border-t border-gray-200 divide-x divide-gray-200">
                            <a class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-es-xl bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                href="{{ Route('show.rental', ['rental' => $rental])  . '?' . $request->getQueryString() }}">
                                View Property
                            </a>
                        </div>
                    </div>
                    <!-- End Card -->         
                @endforeach

            </div>
            <!-- End Grid -->
            @if ($rentals->count() === 0)
                <div class="w-full flex flex-col justify-center items-center h-96">
                    <div class="justify-center items-center flex flex-col">
                        <div class="w-32 ">
                            @svg('eva-question-mark-circle')
                        </div>
                        <p class="font-black text-2xl">We found nothing</p>
                    </div>
                </div>
            @endif
            <div class="mt-8">
                {{ $rentals->links() }}

            </div>

        </div>

        <!-- End Card Blog -->
        
    </x-original.guest-navbar>
</x-guest-layout>