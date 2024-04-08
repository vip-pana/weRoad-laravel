<x-app-layout>
    <x-travel-topbar :travel="$travel" />

    <div class="m-4 max-w-7xl mx-auto">
        <x-card>
            <div class="flex flex-col items-center text-center gap-4">
                <h2 class="text-2xl">{{ $travel->name }}</h2>

                <x-moods-section :moods="$moods" />

                <div class="w-full">
                    <div class="flex justify-between">
                        @if ($tours->count() > 0)
                            @php
                                $lowestPriceTour = $tours->min('price');
                                $lowestPriceTour = intval($lowestPriceTour / 100);
                            @endphp
                            Starting by: {{ $lowestPriceTour }} €
                        @else
                            <span class="bg-red-500 rounded px-6 py-2 text-white self-start">
                                No tours are available.
                            </span>
                        @endif
                        <p>
                            {{ $travel->numberOfDays }} Days • {{ $travel->numberOfDays - 1 }} Nights
                        </p>
                    </div>
                </div>
                <h3 class="text-3xl font-bold">Travel description</h3>
                <p class="text-lg">
                    {{ $travel->description }}
                </p>
            </div>
        </x-card>
        <div class="mt-3">
            <x-card>
                <div class="mb-3">
                    <x-travel-search :travel="$travel" />
                </div>
                <h3 class="text-3xl font-bold mb-3 text-center">Tours</h3>
                @unless (count($tours) == 0)
                    <x-travel-table :tours="$tours" />
                @else
                    <p class="text-center" id="no-tour-text">No tours found</p>
                @endunless
            </x-card>
        </div>
    </div>
</x-app-layout>
