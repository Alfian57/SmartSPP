<div>
    @if ($children->isEmpty())
        <p class="text-danger">Tidak ada anak</p>
    @else
        @foreach ($children as $child)
            <p>{{ $loop->iteration }}. {{ $child->name }}</p>
        @endforeach
    @endif
</div>
