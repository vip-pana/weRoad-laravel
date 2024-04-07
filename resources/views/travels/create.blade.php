<x-app-layout>
    <div class="m-4 max-w-7xl mx-auto">
        <x-card>
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Create a Travel
                </h2>
                <p class="mb-4">Post a travel</p>
            </header>

            <form method="POST" action="{{ route('travels.store') }}">
                @csrf
                <div class="flex flex-col gap-6">
                    <div class="flex gap-6">
                        <div class="w-full">
                            <label for="name" class="inline-block text-lg mb-2">Name</label>
                            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                                value="{{ old('name') }}" required />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label for="numberOfDays" class="inline-block text-lg mb-2">Number of days</label>
                            <input type="number" class="border border-gray-200 rounded p-2 w-full" name="numberOfDays"
                                placeholder="3 (days)" value="{{ old('numberOfDays') }}" required />
                            <p class="text-gray-500 text-xs mt-1">The nights are counted the number of days -1</p>
                            @error('numberOfDays')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="inline-block text-lg mb-2">
                            Description
                        </label>
                        <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="5" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6 flex gap-5 justify-between">
                        <div class="flex gap-1">
                            <label for="isPublic" class="inline-block text-lg">Is public:</label>
                            <input type="checkbox" name="isPublic" value="1"
                                @if (old('isPublic')) checked @endif />
                            @error('isPublic')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-1">
                            <label for="nature" class="inline-block text-lg">Nature:</label>
                            <input type="number" class="w-16" name="nature" placeholder="0 (%)"
                                value="{{ old('nature') }}">
                            <br>
                            @error('nature')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-1">
                            <label for="relax" class="inline-block text-lg">Relax:</label>
                            <input type="number" class="w-16" name="relax" placeholder="0 (%)"
                                value="{{ old('relax') }}">
                            <br>
                            @error('relax')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-1">
                            <label for="history" class="inline-block text-lg">History:</label>
                            <input type="number" class="w-16" name="history" placeholder="0 (%)"
                                value="{{ old('history') }}">
                            <br>
                            @error('history')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-1">
                            <label for="culture" class="inline-block text-lg">Culture:</label>
                            <input type="number" class="w-16" name="culture" placeholder="0 (%)"
                                value="{{ old('culture') }}">
                            <br>
                            @error('culture')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-1">
                            <label for="party" class="inline-block text-lg">Party:</label>
                            <input type="number" class="w-16" name="party" placeholder="0 (%)"
                                value="{{ old('party') }}">
                            <br>
                            @error('party')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div>
                    <button class="bg-teal-600 text-white rounded py-2 px-4 hover:bg-black">
                        Create Travel
                    </button>
                    <a href="{{ back()->getTargetUrl() }}" class="text-black ml-4"> Back </a>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
