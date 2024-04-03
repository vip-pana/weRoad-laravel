<x-card class="p-2 flex space-x-6">
    @can('isEditor')
        <a href="{{ route('travels.edit', ['slug' => $travel->slug]) }}">
            Edit
        </a>
    @endcan
    @can('isAdmin')
        <a href="{{ route('tours.create', ['slug' => $travel->slug]) }}">
            Add a new tour
        </a>

        <form method="POST" action="{{ route('travels.destroy', ['travel' => $travel->id]) }}">
            @csrf
            @method('DELETE')
            <button class="text-red-500">Delete</button>
        </form>
        <a href="{{ route('dashboard') }}" class="text-black ml-4"> Back </a>
    @endcan
</x-card>
