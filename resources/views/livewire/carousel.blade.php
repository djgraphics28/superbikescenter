<div x-data="{ activeIndex: @entangle('activeIndex') }">
    <div class="relative">
        <div class="overflow-hidden rounded-lg">
            <img class="w-full" :src="images[activeIndex].src" alt="Carousel Image">
        </div>
        <div class="absolute bottom-0 left-0 w-full bg-gray-900 bg-opacity-50 py-2">
            <h3 class="text-white text-center text-lg font-bold">{{ $images[$activeIndex]['title'] }}</h3>
        </div>
    </div>

    <div class="flex justify-between mt-2">
        <button @click="activeIndex = (activeIndex - 1 + {{ count($images) }}) % {{ count($images) }}"
                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Previous
        </button>
        <button @click="activeIndex = (activeIndex + 1) % {{ count($images) }}"
                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next
        </button>
    </div>
</div>
