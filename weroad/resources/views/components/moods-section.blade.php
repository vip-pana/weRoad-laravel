<ul class="flex gap-2">
    @foreach ($moods as $key => $mood)
        <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
            {{ $key }}: {{ $mood }}
        </li>
    @endforeach
</ul>
