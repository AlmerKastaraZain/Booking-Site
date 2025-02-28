<x-original.dashboard>
    <x-guest-layout>
        <h1 class="text-2xl font-black pb-5"> Create Rental </h1>
        <form action="{{ Route('store.rental') }}" method="POST">
            @csrf
            <div class="mb-6 lg:flex gap-4">
                <div class="lg:w-[50%] w-[100%]">


                    <div class="flex gap-4">
                        <div class="w-full">
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                placeholder="Garuda Villa" required autofocus />
                        </div>
                    </div>
                    @error('name')
                        <div class="ml-4 text-red-700">{{ $message }}</div>
                    @enderror

                    <div class=" flex gap-4">
                        <div class="w-full">

                            <x-label for="desc" value="{{ __('Description') }}" />
                            <x-textarea id="number" class="block mt-1 w-full number" name="desc"
                                placeholder="Rental Description..." required autofocus></x-textarea>
                        </div>
                    </div>
                    @error('desc')
                        <div class="ml-4 text-red-700">{{ $message }}</div>
                    @enderror

                    <p id="plan-desc" class="opacity-60 pl-2"></p>
                    <script src="{{ asset('js/dynamic-or-fixed.js') }}" defer></script>

                    <h3 class="mt-4 mb-1 font-semibold text-gray-900">Facilities</h3>
                    <x-original.facilities>
                        <x-original.facilities-item name="free_parking" value="Free Parking" />
                        <x-original.facilities-item name="restaurant" value="Restaurant" />
                        <x-original.facilities-item name="pet_friendly" value="Pet" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item name="hour" value="24-hour front desk" />
                        <x-original.facilities-item name="fitness_center" value="Fitness center" />
                        <x-original.facilities-item name="non_smoking_rooms" value="Non-smoking rooms" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item name="airport_shuttle" value="Airport shuttle" />
                        <x-original.facilities-item name="family_rooms" value="Family rooms" />
                        <x-original.facilities-item name="spa" value="Spa" />
                    </x-original.facilities>
                    <x-original.facilities>
                        <x-original.facilities-item name="electric_vehicle" value="Electric vehicle charging station" />
                        <x-original.facilities-item name="wheelchair" value="Wheelchair accessible" />
                        <x-original.facilities-item name="swimming_pool" value="Swimming pool" />
                    </x-original.facilities>


                    <p class="mt-4"></p>

                    <p id="property-error-msg" class="text-red-700 hidden">You must choose a property type...
                    </p>
                    <x-original.combobox value="a" id="property-combobox" :label="'Pick Property Type'"
                        :default="'Property'" :for="'property'" :option="'Pick your property type'">
                        <x-original.combobox-option :value="'Apartments'">
                            Apartments
                        </x-original.combobox-option>
                        <x-original.combobox-option :value="'Hotels'">
                            Hotels
                        </x-original.combobox-option>
                        <x-original.combobox-option :value="'Guesthouses'">
                            Guesthouses
                        </x-original.combobox-option>
                        <x-original.combobox-option :value="'Hostels'">
                            Hostels
                        </x-original.combobox-option>
                        <x-original.combobox-option :value="'Homestays'">
                            Homestays
                        </x-original.combobox-option>
                        <x-original.combobox-option :value="'Capsule Hotels'">
                            Capsule Hotels
                        </x-original.combobox-option>
                        <x-original.combobox-option :value="'Motels'">
                            Motels
                        </x-original.combobox-option>
                        <x-original.combobox-option :value="'Vacation Homes'">
                            Vacation Homes
                        </x-original.combobox-option>
                        <x-original.combobox-option :value="'Bed and Breakfasts'">
                            Bed and Breakfasts
                        </x-original.combobox-option>
                        <x-original.combobox-option :value="'Villas'">
                            Villas
                        </x-original.combobox-option>
                        <x-original.combobox-option :value="'Resorts'">
                            Resorts
                        </x-original.combobox-option>
                        <x-original.combobox-option :value="'Luxurty Tents'">
                            Luxury tents
                        </x-original.combobox-option>
                    </x-original.combobox>


                </div>
                <div class="w-full lg:w-1/2  h-full ">
                    <p class="pt-8 lg:pt-0"></p>
                    @error('latitude')
                        <div class="ml-4 text-red-700">{{ 'Please fill out this map...' }}</div>
                    @enderror

                    <div style="display: none">
                        <input style="margin-top: 8px; width: 60%;" id="pac-input" class="controls" type="text"
                            placeholder="Enter a location" />
                    </div>
                    <div id="map"></div>
                    <div id="infowindow-content">
                        <span id="place-name" class="title"></span><br />
                        <span class="hidden">
                            <strong>Place ID</strong>: <span id="place-id"></span><br />
                            <span id="place-address"></span>
                        </span>
                    </div>

                    <script
                        src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_API')}}&callback=initMap&libraries=places&v=weekly"
                        defer></script>
                    <script>
                        //function initMap() {
                        //    const map = new google.maps.Map(document.getElementById("map"), {
                        //        zoom: 4,
                        //        center: { lat: -25.363, lng: 131.044 },
                        //        mapTypeControl: false,
                        //        streetViewControl: false,
                        //        mapTypeId: "roadmap",
                        //    });
                        //    var marker;
                        //    google.maps.event.addListener(map, 'click', function (event) {
                        //        placeMarker(event.latLng);
                        //    });
                        //    function placeMarker(location) {
                        //        if (marker == null) {
                        //            marker = new google.maps.Marker({
                        //                position: location,
                        //                map: map
                        //            });
                        //        }
                        //        else {
                        //            marker.setPosition(location);
                        //        }
                        //    }
                        //    new google.maps.Marker({
                        //        map,
                        //        title: "Hello World!",
                        //    });
                        //}
                        //window.initMap = initMap;

                        // This sample requires the Places library. Include the libraries=places

                        var elem = null;
                        function updateHTML(elmId, finalValue) {

                            elem = document.getElementById(elmId);
                            if (typeof elem !== 'undefined' && elem !== null) {
                                document.getElementById(elmId).value = finalValue;
                            }
                            elem = null;
                        }

                        function initMap() {
                            const map = new google.maps.Map(document.getElementById("map"), {
                                center: { lat: -33.8688, lng: 151.2195 },
                                zoom: 13,
                            });
                            const input = document.getElementById("pac-input");
                            // Specify just the place data fields that you need.
                            const autocomplete = new google.maps.places.Autocomplete(input, {
                                fields: ["place_id", "geometry", "name", "formatted_address"],
                            });

                            autocomplete.bindTo("bounds", map);
                            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                            const infowindow = new google.maps.InfoWindow();
                            const infowindowContent = document.getElementById("infowindow-content");

                            infowindow.setContent(infowindowContent);

                            const geocoder = new google.maps.Geocoder();
                            const marker = new google.maps.Marker({ map: map });

                            marker.addListener("click", () => {
                                infowindow.open(map, marker);
                            });

                            google.maps.event.addListener(map, 'click', function (event) {
                                infowindow.close();
                                marker.setPosition(event.latLng);
                                marker.setVisible(true);

                                geocoder.geocode({
                                    'latLng': event.latLng
                                }, function (results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {

                                        var filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("administrative_area_level_1");
                                        });
                                        updateHTML('administrative_area_level_1', filtered_array.length ? filtered_array[0].long_name : "");

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

                                        var latitude = results[0].geometry.location.lat();
                                        var longitude = results[0].geometry.location.lng();
                                        updateHTML('latitude', latitude);
                                        updateHTML('longitude', longitude);
                                        updateHTML('full_address', results[0].formatted_address)

                                        autocomplete.value = results[0].formatted_address
                                        document.getElementById("pac-input").value = results[0].formatted_address
                                    }
                                });
                            });


                            autocomplete.addListener("place_changed", () => {
                                infowindow.close();

                                const place = autocomplete.getPlace();

                                if (!place.place_id) {
                                    return;
                                }

                                geocoder
                                    .geocode({ placeId: place.place_id })
                                    .then(({ results }) => {
                                        map.setZoom(11);
                                        map.setCenter(results[0].geometry.location);
                                        // Set the position of the marker using the place ID and location.
                                        // @ts-ignore TODO This should be in @typings/googlemaps.
                                        marker.setPlace({
                                            placeId: place.place_id,
                                            location: results[0].geometry.location,
                                        });
                                        marker.setVisible(true);
                                        infowindowContent.children["place-name"].textContent = place.name;
                                        results[0].formatted_address;
                                        infowindow.open(map, marker);

                                        var filtered_array = results[0].address_components.filter(function (address_component) {
                                            return address_component.types.includes("administrative_area_level_1");
                                        });
                                        updateHTML('administrative_area_level_1', filtered_array.length ? filtered_array[0].long_name : "");

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

                                        var latitude = results[0].geometry.location.lat();
                                        var longitude = results[0].geometry.location.lng();
                                        updateHTML('latitude', latitude);
                                        updateHTML('longitude', longitude);
                                        updateHTML('full_address', results[0].formatted_address)
                                    })
                                    .catch((e) => window.alert("Geocoder failed due to: " + e));
                            });
                        }
                        window.initMap = initMap;
                    </script>
                    <input type="text" id="street_address" name="street_address" class="hidden">
                    <input type="text" id="route" name="route" class="hidden">
                    <input type="text" id="country" name="country" class="hidden">
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