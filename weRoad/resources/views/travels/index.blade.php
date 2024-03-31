<x-layout>
    @include('partials._hero')

    @include('partials._search')

    @unless (count($travels) == 0)
        @foreach ($travels as $travel)
            <div class="m-6">
                <x-travel-card :travel="$travel" />
            </div>
        @endforeach
    @else
        <p class="text-center"><strong>No travels found</strong></p>
    @endunless
</x-layout>
