@props(['name', 'name_input'])

<div class="border border-gray-200 w-full items-center flex ">
    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
        <div class="flex items-center ps-3">
            <input id="item" name="{{ $name }}" type="checkbox" value="{{ $name }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
            <label for="vue-checkbox-list"  class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">{{ $slots }}</label>
        </div>


    </li>
    <div id="item-cost-container" class="max-w-0 transition-width w-full h-16 overflow-hidden flex flex-col transition-height justify-center items-center" >
        <p>Wifi Cost</p>
        <x-input placeholder="0..." value="0" name="{{ $name_input }}" type="number" class="w-[80%] h-6 my-2 number" />
    </div>
    <script defer>
        const item = document.getElementById("item")
        const itemCostContainer = document.getElementById("item-cost-container")
        item.addEventListener("click", () => {
            if (item.checked == true) {
                itemCostContainer.style = "max-width: 100%;"
            } else {
                itemCostContainer.style = ""
            }
        })
    </script>
</div>
