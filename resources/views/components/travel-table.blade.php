<table class="w-full table-fixed border ">
    <thead>
        <tr class="border ">
            <th>Name</th>
            <th>Date</th>
            <th>Price</th>
            @can('isAdmin')
                <th>Actions</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @foreach ($tours as $tour)
            <tr class="border">
                <td class="border text-center">{{ $tour->name }}</td>
                <td class="border text-center">
                    {{ \Carbon\Carbon::parse($tour->startingDate)->format('m/d/Y') }} ->
                    {{ \Carbon\Carbon::parse($tour->endingDate)->format('m/d/Y') }}
                </td>
                <td class="border text-center">
                    {{ number_format(intval($tour->price / 100), -4, ',', '.') }} €
                </td>
                @can('isAdmin')
                    <td>
                        <div class="flex justify-around">
                            <a href="/tours/{{ $tour->id }}/edit" class="edit-travel-link">
                                <i class="fa-solid fa-pencil"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('tours.destroy', ['tour' => $tour->id]) }}"
                                class="delete-travel-form">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500"><i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                @endcan
            </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-8">
    {{ $tours->links() }}
</div>
