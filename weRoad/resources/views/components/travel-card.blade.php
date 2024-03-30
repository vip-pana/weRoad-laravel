@props(['travel'])

<x-card>
    <div class="flex">
        {{-- <img class="hidden w-48 mr-6 md:block"
      src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png')}}" alt="" /> --}}
        <div>
            <h3 class="text-2xl">
                <a href="/travels/{{ $travel['id'] }}">{{ $travel['name'] }}</a>
            </h3>
            {{-- <div class="flex flex-row">
                <span class="font-bold text-gray-500">Start Date: </span>
            </div> --}}
            {{-- <div class="text-xl font-bold mb-4">{{ $tour['startingDate'] }}</div> --}}
            {{-- <x-listing-tags :tagsCsv="$listing->tags" /> --}}
            <div class="text-lg mt-4">
                {{-- <i class="fa-solid fa-location-dot"></i> {{ $tour['endingDate'] }} --}}
            </div>
        </div>
    </div>
</x-card>
