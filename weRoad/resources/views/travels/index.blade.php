<x-layout>
    @if (!Auth::check())
        @include('partials._hero')
    @endif

    @include('partials._search')

    @unless (count($travels) == 0)
        @foreach ($travels as $travel)
            <x-travel-card :travel="$travel" />
        @endforeach
    @else
        <p>No travels found</p>
    @endunless
</x-layout>
