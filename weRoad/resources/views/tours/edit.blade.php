<x-app-layout>
    <div class="m-4">
        <x-card>
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Edit: {{ $tour->name }}
                </h2>
                <p class="mb-4">Edit the tour</p>
            </header>

            <form method="POST" action="{{ route('tours.update', ['tour' => $tour->id]) }}">
                @method('PUT')
                @csrf
                <div class="flex flex-col gap-6 mb-6">
                    <div>
                        <label for="name" class="inline-block text-lg mb-2">Name</label>
                        <input type="textPost a tour" class="border border-gray-200 rounded p-2 w-full" name="name"
                            value="{{ $tour->name }}" required />
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-between gap-6">
                        <div class="w-full">
                            <label for="startingDate" class="inline-block text-lg mb-2">Starting date</label>
                            <input type="date" class="border border-gray-200 rounded p-2 w-full" name="startingDate"
                                value="{{ $tour->startingDate }}" required />
                            @error('startingDate')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="endingDate" class="inline-block text-lg mb-2">Ending date</label>
                            <input type="date" class="border border-gray-200 rounded p-2 w-full" name="endingDate"
                                value="{{ $tour->endingDate }}" required />
                            @error('endingDate')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        @php
                            $priceFixed = $tour->price / 100;
                        @endphp
                        <label for="price" class="inline-block text-lg mb-2">Price</label>
                        <input type="number" class="border border-gray-200 rounded p-2 w-full" name="price"
                            value="{{ $priceFixed }}" required />
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <button class="bg-teal-600 text-white rounded py-2 px-4 hover:bg-black">
                        Update Tour
                    </button>
                    <a href="{{ back()->getTargetUrl() }}" class="text-black ml-4"> Back </a>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
