@props(['travel'])

<x-card>
    <div class="flex">
        <div>
            <h3 class="text-2xl">
                <a href="/travels/{{ $travel['id'] }}">{{ $travel['name'] }}</a>
            </h3>
        </div>
    </div>
</x-card>
