    <x-card>
        <form action="{{ route('travels.show', ['slug' => $travel->slug]) }}" method="GET" id="tours-filters">
            <div class="flex flex-wrap gap-3">
                <div class="flex flex-col">
                    <label for="dateFrom">Date from:</label>
                    <input type="date" value="{{ old('dateFrom') }}" name="dateFrom">
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
                <div class="flex flex-col">
                    <label for="orderBy">Order by:</label>
                    <select name="orderBy">
                        <option value="">Order by price</option>
                        <option value="ASC">Lower to higher</option>
                        <option value="DESC">Higher to lower</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-between">
                <div class=""></div>
                <div class="">
                    <button type="submit" class=" h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">
                        Search
                    </button>
                    <a class="ms-3" href="{{ route('travels.show', ['slug' => $travel->slug]) }}">Clear</a>
                </div>
            </div>

        </form>
    </x-card>
