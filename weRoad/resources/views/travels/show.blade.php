<x-app-layout>
    <div class="m-4">
        <x-card>
            <div class="flex flex-col items-center text-center gap-4">
                <h2 class="text-2xl">{{ $travel->name }}</h2>

                <ul class="flex gap-2">
                    @foreach ($moods as $key => $mood)
                        <li class="flex items-center justify-center bg-black  rounded-xl py-1 px-3 mr-2 text-xs">
                            {{ $key }}: {{ $mood }}
                        </li>
                    @endforeach
                </ul>

                <div class="w-full">
                    <div class="flex justify-between">
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
                                @can('isAdmin')
                                    <div class="flex justify-between">
                                        <a href="/tours/{{ $tour->id }}/edit">
                                            <i class="fa-solid fa-pencil"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('tours.destroy', ['tour' => $tour->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                @endcan
                            </x-card>
                        @endforeach
                    @else
                        <p>No tours found</p>
                    @endunless
                </div>
            </x-card>
        </div>

        <x-card class="mt-4 p-2 flex space-x-6">
            @can('isEditor')
                <a href="{{ route('travels.edit', ['travel' => $travel->id]) }}">
                    <i class="fa-solid fa-pencil"></i> Edit
                </a>
            @endcan
            @can('isAdmin')
                <a href="{{ route('tours.create', ['travel' => $travel->id]) }}">
                    <i class="fa-plus fa-pencil"></i> Add a new tour
                </a>

                <form method="POST" action="{{ route('travels.destroy', ['travel' => $travel->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
                <a href="{{ route('dashboard') }}" class="text-black ml-4"> Back </a>
            @endcan
        </x-card>
    </div>
</x-app-layout>
