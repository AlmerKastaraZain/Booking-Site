<x-guest-layout>
    <x-original.dashboard>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-6  px-10 lg:p-8 overflow-hidden shadow-xl sm:rounded-lg">

                    <h1 class="text-2xl font-black pb-5"> Manage Room Type Image </h1>
                    <x-original.drag-and-drop :url="Route('room.image.store', ['rental' => $rental, 'roomtype' => $roomtype])" />
                    <div class="image-gallery">
                        @foreach ($images as $image)
                            <form class="image-card relative"
                                action="{{ Route('room.image.delete', ['rental' => $rental, 'roomtype' => $roomtype, 'image' => $image->id]) }}"
                                method="get">
                                <img class="image -z-10" src="{{ url('storage/room_images/' . $image->src)}}" alt=""
                                    alt="{{ $image->title }}">
                                <div
                                    class="absolute cover  hover:opacity-100 flex justify-center items-center bg-black bg-opacity-20 opacity-0 transition-opacity z-10 top-0 left-0 w-[100%] h-[100%]">
                                    <x-button class="bg-red-600 ">Delete</x-button>
                                </div>
                            </form>
                        @endforeach

                    </div>
                </div>
            </div>
    </x-original.dashboard>
</x-guest-layout>