@props(['travel'])

<x-card>
    <div class="flex justify-between">
        <h3 class="text-2xl ">
            <a href="/travels/{{ $travel['id'] }}">{{ $travel['name'] }}</a>
        </h3>
    </div>
</x-card>
