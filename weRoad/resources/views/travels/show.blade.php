<x-layout>
    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i>Back
    </a>
    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center  text-center">
                <h3 class="text-2xl mb-2">{{ $travel['name'] }}</h3>

                <div class="flex flex-row gap-2">

                    @foreach ($moods as $key => $mood)
                        <div class="flex flex-row gap-1">
                            <p>{{ $key }}: {{ $mood }}</p>
                        </div>
                    @endforeach
                </div>
                <div>
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
                            {{ $travel['numberOfDays'] }} Giorni • {{ $travel['numberOfDays'] - 1 }} Notti
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold mb-4">Travel description</h3>
                    <div class="text-lg space-y-6">
                        {{ $travel['description'] }}
                    </div>
                </div>
            </div>
        </x-card>

        <x-card class="mt-4 p-2 flex space-x-6">
            <a href="/travels/{{ $travel->id }}/edit">
                <i class="fa-solid fa-pencil"></i> Edit
            </a>

            <form method="POST" action="/travels/{{ $travel->id }}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
        </x-card>
    </div>
</x-layout>
