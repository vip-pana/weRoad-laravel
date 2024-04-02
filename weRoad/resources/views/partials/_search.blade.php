<div class="mt-4">
    <x-card>
        <form action="/" method="GET">
            <div class="flex gap-3">
                <div class="flex flex-col">
                    <label for="dateFrom">Date from:</label>
                    <input type="date" value="{{ old('dateFrom', now()->toDateString()) }}" name="dateFrom">
                </div>
                <div class="flex flex-col">
                    <label for="dateTo">Date To:</label>
                    <input type="date" value="{{ old('dateTo') }}" name="dateTo">
                </div>
                <div class="flex flex-col">
                    <label for="priceFrom">Price from:</label>
                    <input type="number" placeholder="ex. 1€" value="{{ old('priceFrom') }}" name="priceFrom">
                    <p class="text-gray-500 text-xs mt-1">All the price input are referred in €.</p>
                </div>
                <div class="flex flex-col">
                    <label for="priceTo">Price To:</label>
                    <input type="number" placeholder="ex. 1000€" value="{{ old('priceTo') }}" name="priceTo">
                </div>
            </div>

            <button type="submit" class=" h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">
                Search
            </button>
            <a class="ms-3" href="{{ route('dashboard') }}">Clear</a>

        </form>
    </x-card>
</div>
