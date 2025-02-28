@props([
    'wifi_check' => '',
    'breakfast_check' => '',
    'service_check' => '',
    'wifi_cost' => '',
    'breakfast_cost' => '',
    'service_cost' => '',
])

<div>
    <h3 class="mt-4 mb-1 font-semibold text-gray-900">Rental Services</h3>
    <ul class="items-center z-20 w-full flex-col text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
        <div class="border border-gray-200 w-full items-center flex ">
            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                
                <div class="flex items-center ps-3">
                    
                    @if ($wifi_check !== '')
                        <input id="wifi" name="wifi" type="checkbox" value="wifi" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 " checked>
                    @else
                        <input id="wifi" name="wifi" type="checkbox" value="wifi" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    @endif
                    <label for="vue-checkbox-list"  class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">Wifi</label>
                </div>
            </li>
            <div id="wifi-cost-container" class="max-w-0 transition-width w-full h-16 overflow-hidden flex flex-col transition-height justify-center items-center" >
                <p>Wifi Cost</p>
                <div class="flex justify-center items-center">
                    <label class="text-white bg-black px-2 mr-1 py-1 rounded-md" for="bed">USD</label>
                    <x-input placeholder="0" value="{{ ($wifi_cost !== '') ? $wifi_cost : '0'  }}" name="wifi_cost" type="number" class="w-[80%] h-6 my-2 number" />
                </div>
            </div>
        </div>

        <script defer>
            const wifi = document.getElementById("wifi")
            const wifiCostContainer = document.getElementById("wifi-cost-container")
            wifi.addEventListener("click", () => {
                WifiToggle();
            })

            function WifiToggle() {
                if (wifi.checked == true) {
                    wifiCostContainer.style = "max-width: 100%; padding-inline: 1rem;"
                } else {
                    wifiCostContainer.style = ""
                }
            }
        </script>
        @if ($wifi_check !== '')
            <script defer>WifiToggle();</script>
        @endif
        <div class="border border-gray-200 w-full items-center flex">
            <li class="w-full  border-b border-gray-200 sm:border-b-0 sm:border-r">
                <div class="flex items-center ps-3">
                    @if ($breakfast_check !== '')
                        <input id="breakfast" name="breakfast" type="checkbox" value="breakfast" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 " checked>
                    @else
                        <input id="breakfast" name="breakfast" type="checkbox" value="breakfast" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    @endif
                    <label for="vue-checkbox-list" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">Breakfast</label>

                </div>

            </li>
            <div id="breakfast-cost-container" class="max-w-0 h-16 overflow-hidden transition-width w-full flex flex-col transition-height justify-center items-center" >
                <p>Breakfast Cost</p>
                <div class="flex justify-center items-center">
                    <label class="text-white bg-black px-2 mr-1 py-1 rounded-md" for="bed">USD</label>
                <x-input placeholder="0" name="breakfast_cost" value="{{ ($breakfast_cost !== '') ? $breakfast_cost : '0'  }}" type="number" class="w-[80%] h-6 my-2 number" />
                </div>
            </div>
            <script defer>
                const breakfast = document.getElementById("breakfast")
                const breakfastCostContainer = document.getElementById("breakfast-cost-container")
                breakfast.addEventListener("click", () => {
                    BreakfastToggle() 
                })


                function BreakfastToggle() {
                    if (breakfast.checked == true) {
                        breakfastCostContainer.style = "max-width: 100%; padding-inline: 1rem;"
                    } else {
                        breakfastCostContainer.style = ""
                    }
                }
            </script>
                    @if ($breakfast_check !== '')
                    <script defer>BreakfastToggle();</script>
                @endif
        </div>

        <div class="border border-gray-200 items-center w-full flex">
            <li class="w-full border-b  border-gray-200 sm:border-b-0 sm:border-r">
                <div class="flex items-center ps-3">
                    @if ($service_check !== '')
                        <input id="service" name="service" type="checkbox" value="breakfast" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 " checked>
                    @else
                        <input id="service" name="service" type="checkbox" value="breakfast" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                    @endif
                    <label for="vue-checkbox-list"  class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">Room Service</label>

                </div>
            </li>
            <div id="service-cost-container" class="max-w-0 h-16 overflow-hidden transition-width w-full flex flex-col transition-height justify-center items-center" >
                <p>Service Cost</p>
                <div class="flex justify-center items-center">
                    <label class="text-white bg-black px-2 mr-1 py-1 rounded-md" for="bed">USD</label>
                <x-input placeholder="0" name="service_cost" value="{{ ($service_cost !== '') ? $service_cost : '0'  }}" type="number" class="w-[80%] h-6 my-2 number" />
                </div>
            </div>
            <script defer>
                const service = document.getElementById("service")
                const serviceCostContainer = document.getElementById("service-cost-container")
                service.addEventListener("click", () => {
                    ServiceToggle();
                })

                function ServiceToggle() {
                    if (service.checked == true) {
                        serviceCostContainer.style = "max-width: 100%; padding-inline: 1rem;"
                    } else {
                        serviceCostContainer.style = ""
                    }
                }
            </script>
                    @if ($service_check !== '')
                    <script defer>ServiceToggle();</script>
                @endif
        </div>

    </ul>
</div>