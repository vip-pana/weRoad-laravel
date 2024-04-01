<x-app-layout>
    <div class="mx-4">
        <x-card>
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Edit: {{ $travel->name }}
                </h2>
                <p class="mb-4">Edit the travel</p>
            </header>

            <form method="POST" action="{{ route('travels.update', [('travel')->$travel->id]) }}">
                @csrf
                @method('PUT')
                <div class="flex gap-3 justify-between mb-6">
                    <div class="w-full">
                        <label for="name" class="inline-block text-lg mb-2">Name</label>
                        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                            value="{{ $travel->name }}" required />
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="numberOfDays" class="inline-block text-lg mb-2">Number of days</label>
                        <input type="number" class="border border-gray-200 rounded p-2 w-full" name="numberOfDays"
                            placeholder="3 (days)" value="{{ $travel->numberOfDays }}" required />
                        <p class="text-gray-500 text-xs mt-1">The nights are counted the number of days -1</p>
                        @error('numberOfDays')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="inline-block text-lg mb-2">
                        Description
                    </label>
                    <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="5" required>{{ $travel->description }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 flex gap-5 justify-between">
                    <div>
                        <label for="isPublic" class="inline-block text-lg">Is public:</label>
                        <input type="checkbox" name="isPublic" value="{{ $travel->isPublic }}" />
                    </div>
                    @foreach ($moods as $key => $mood)
                        <div class="flex gap-1">
                            <label for="{{ $key }}" class="inline-block text-lg">{{ ucfirst($key) }}:</label>
                            <input type="number" class="w-16" name="{{ $key }}" placeholder="0 (%)"
                                value="{{ $mood }}" />
                            <br>
                            @error('{{ $key }}')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <button class="bg-teal-600 text-white rounded py-2 px-4 hover:bg-black">
                    Update Travel
                </button>
                <a href="{{ route('dashboard') }}" class="text-black ml-4"> Back </a>
            </form>
        </x-card>
    </div>
</x-app-layout>
