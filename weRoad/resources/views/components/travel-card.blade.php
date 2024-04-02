@props(['travel'])

<x-card>
    <div class="flex justify-between">
        <h3 class="text-2xl ">
            {{ $travel->name }}
        </h3>
        <div class="flex flex-col">
            @php
                $startingDates = $travel->tours->pluck('startingDate');
                $oldestStartingDate = $startingDates->min();
                $newestStartingDate = $startingDates->max();

                $maxPriceTour = $travel->tours->max('price');
                $maxPriceTour = intval($maxPriceTour / 100);
                $formattedMaxPrice = number_format($maxPriceTour, -4, ',', '.');

                $lowestPriceTour = $travel->tours->min('price');
                $lowestPriceTour = intval($lowestPriceTour / 100);
                $formattedLowestPrice = number_format($lowestPriceTour, -4, ',', '.');
            @endphp
            <p>Next Tour: {{ \Carbon\Carbon::parse($oldestStartingDate)->format('m/d/Y') }}</p>
            <p>Last Tour: {{ \Carbon\Carbon::parse($newestStartingDate)->format('m/d/Y') }}</p>
            <p>Starting from: {{ $formattedLowestPrice }}€</p>
            <p>Max price: {{ $formattedMaxPrice }}€</p>
        </div>
        <div class="flex gap-5">
            <a href="{{ route('travels.show', ['slug' => $travel->slug]) }}">View</a>
            @can('isEditor')
                <a href="{{ route('travels.edit', ['id' => $travel->id]) }}">Edit</a>
            @endcan
        </div>
    </div>
</x-card>
