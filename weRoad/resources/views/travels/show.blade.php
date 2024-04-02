<x-app-layout>
    <x-card class="p-2 flex space-x-6">
        @can('isEditor')
            <a href="{{ route('travels.edit', ['travel' => $travel->id]) }}">
                Edit
            </a>
        @endcan
        @can('isAdmin')
            <a href="{{ route('tours.create', ['travel' => $travel->id]) }}">
                Add a new tour
            </a>

            <form method="POST" action="{{ route('travels.destroy', ['travel' => $travel->id]) }}">
                @csrf
                @method('DELETE')
                <button class="text-red-500">Delete</button>
            </form>
            <a href="{{ route('dashboard') }}" class="text-black ml-4"> Back </a>
        @endcan
    </x-card>
    <div class="m-4 max-w-7xl mx-auto">
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
                <div class="mb-3">
                    <x-card>
                        <form action="{{ route('travels.show', ['slug' => $travel->slug]) }}" method="GET">
                            @csrf
                            <div class="flex gap-3">
                                <div class="flex flex-col">
                                    <label for="dateFrom">Date from:</label>
                                    <input type="date" value="{{ old('dateFrom') }}" name="dateFrom">
                                </div>
                                <div class="flex flex-col">
                                    <label for="dateTo">Date To:</label>
                                    <input type="date" value="{{ old('dateTo') }}" name="dateTo">
                                </div>
                                <div class="flex flex-col">
                                    <label for="priceFrom">Price from:</label>
                                    <input type="number" placeholder="ex. 1€" value="{{ old('priceFrom') }}"
                                        name="priceFrom">
                                    <p class="text-gray-500 text-xs mt-1">All the price input are referred in €.</p>
                                </div>
                                <div class="flex flex-col">
                                    <label for="priceTo">Price To:</label>
                                    <input type="number" placeholder="ex. 1000€" value="{{ old('priceTo') }}"
                                        name="priceTo">
                                </div>
                                <div class="flex flex-col">
                                    <label for="orderBy">Order by:</label>
                                    <select name="orderBy">
                                        <option value="">Order by price</option>
                                        <option value="ASC">Lower to highest</option>
                                        <option value="DESC">Highest to lower</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <div class=""></div>
                                <div class="">
                                    <button type="submit"
                                        class=" h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">
                                        Search
                                    </button>
                                    <a class="ms-3"
                                        href="{{ route('travels.show', ['slug' => $travel->slug]) }}">Clear</a>
                                </div>
                            </div>

                        </form>
                    </x-card>
                </div>


                <h3 class="text-3xl font-bold mb-3 text-center">Tours</h3>
                <table class="w-full table-fixed border ">
                    <thead>
                        <tr class="border ">
                            <th>Name</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless (count($tours) == 0)
                            @foreach ($tours as $tour)
                                <tr class="border">
                                    <td class="border text-center">{{ $tour->name }}</td>
                                    <td class="border text-center">
                                        {{ \Carbon\Carbon::parse($tour->startingDate)->format('m/d/Y') }} ->
                                        {{ \Carbon\Carbon::parse($tour->endingDate)->format('m/d/Y') }}
                                    </td>
                                    <td class="border text-center">
                                        {{ number_format(intval($tour->price / 100), -4, ',', '.') }} €
                                    </td>
                                    <td>
                                        <div class="flex justify-around">
                                            <a href="/tours/{{ $tour->id }}/edit">
                                                <i class="fa-solid fa-pencil"></i> Edit
                                            </a>
                                            <form method="POST"
                                                action="{{ route('tours.destroy', ['tour' => $tour->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-500"><i class="fa-solid fa-trash"></i>
                                                    Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p>No tours found</p>
                        @endunless
                    </tbody>
                </table>
                <div class="mt-8">
                    {{ $tours->links() }}
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
