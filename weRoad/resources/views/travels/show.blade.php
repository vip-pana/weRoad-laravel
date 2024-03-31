<x-layout>
    <a href="/" class="inline-block ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center text-center gap-4">
                <h3 class="text-2xl">{{ $travel->name }}</h3>

                <div class="flex gap-2">
                    @foreach ($moods as $key => $mood)
                        <p>{{ $key }}: {{ $mood }}</p>
                    @endforeach
                </div>

                <div class="w-full">
                    <div class="flex flex-row gap-2 justify-between">
                        @if ($tours->count() > 0)
                            @php
                                $lowestPriceTour = $tours->min('price');
                                $lowestPriceTour = intval($lowestPriceTour / 100);
                                $formattedPrice = number_format($lowestPriceTour, -4, ',', '.');
                            @endphp
                            Starting by: {{ $formattedPrice }} €
                        @else
                            <span class="bg-red-500 rounded px-6 py-2 text-white self-start">
                                No tours are available.
                            </span>
                        @endif
                        <div>
                            {{ $travel->numberOfDays }} Days • {{ $travel->numberOfDays - 1 }} Nights
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-bold mb-5">Travel description</h3>
                    <div class="text-lg">
                        {{ $travel->description }}
                    </div>
                </div>
            </div>
        </x-card>
        <div class="mt-3">
            <x-card>
                <h3 class="text-3xl font-bold mb-3 text-center">Tours</h3>
                <div class="flex flex-wrap justify-around gap-3">
                    @unless (count($tours) == 0)
                        @foreach ($tours as $tour)
                            <x-card class="w-96 flex flex-col gap-3 text-center">
                                <p>
                                    {{ $tour->name }}
                                </p>
                                <p>
                                    {{ $tour->startingDate }} -> {{ $tour->endingDate }}
                                </p>
                                <p>
                                    {{ number_format(intval($tour->price / 100), -4, ',', '.') }} €
                                </p>
                                <div class="flex justify-between">
                                    <a href="/tours/{{ $tour->id }}/edit">
                                        <i class="fa-solid fa-pencil"></i> Edit
                                    </a>
                                    <form method="POST" action="/tours/{{ $tour->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </x-card>
                        @endforeach
                    @else
                        <p>No tours found</p>
                    @endunless
                </div>
            </x-card>
        </div>

        <x-card class="mt-4 p-2 flex space-x-6">
            <a href="/travels/{{ $travel->id }}/edit">
                <i class="fa-solid fa-pencil"></i> Edit
            </a>

            <a href="/travels/{{ $travel->id }}/tours/create">
                <i class="fa-plus fa-pencil"></i> Add a new tour
            </a>

            <form method="POST" action="/travels/{{ $travel->id }}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
        </x-card>
    </div>
</x-layout>
