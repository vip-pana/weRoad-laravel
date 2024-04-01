@props(['travel'])

<x-card>
    <div class="flex justify-between">
        <h3 class="text-2xl ">
            {{ $travel->name }}
        </h3>
        <div class="flex gap-5">
            <a href="{{ route('travels.show', ['travel' => $travel->id]) }}">View</a>
            @can('isEditor')
                <a href="{{ route('travels.edit', ['id' => $travel->id]) }}">Edit</a>
            @endcan
        </div>
    </div>
</x-card>
