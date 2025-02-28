<x-guest-layout>
    <x-original.dashboard>
        <h1 class="text-2xl font-black pb-5"> Create Rental </h1>
        <x-original.drag-and-drop :url="Route('rental.image.store', ['rental' => $rental])" />
        <div class="image-gallery">
            @foreach ($images as $image)
                <form class="image-card relative"
                    action="{{ Route('rental.image.delete', ['rental' => $rental, 'image' => $image->id]) }}" method="get">
                    <img class="image -z-10" src="{{ url('storage/rental_images/' . $image->src)}}" alt=""
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