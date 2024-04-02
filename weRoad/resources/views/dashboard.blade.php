<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @unless (count($travels) == 0)
            @foreach ($travels as $travel)
                <div class="mt-8">
                    <x-travel-card :travel="$travel" />
                </div>
            @endforeach
        @else
            <h1 class="m-6 text-3xl text-center font-bold">No travels found</h1>
        @endunless
        <div class="mt-8">
            {{ $travels->links() }}
        </div>
    </div>
</x-app-layout>
