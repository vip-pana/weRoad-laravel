@props(['travel'])

<x-card>
    <div class="flex justify-between">
        <h3 class="text-2xl w-96">
            {{ $travel->name }}
        </h3>
        <div>
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
            @if (count($travel->tours) != 0)
                <p>Next Tour: {{ \Carbon\Carbon::parse($oldestStartingDate)->format('m/d/Y') }}</p>
                <p>Last Tour: {{ \Carbon\Carbon::parse($newestStartingDate)->format('m/d/Y') }}</p>
                <p>Starting from: {{ $formattedLowestPrice }}€</p>
                <p>Max price: {{ $formattedMaxPrice }}€</p>
            @else
                No tours available
            @endif
        </div>
        <div>
            <a href="{{ route('travels.show', ['slug' => $travel->slug]) }}" id="view-{{ $travel->id }}">View</a>
            @can('isEditor')
                <a href="{{ route('travels.edit', ['slug' => $travel->slug]) }}" id="edit-{{ $travel->id }}">Edit</a>
            @endcan
        </div>
    </div>
</x-card>
