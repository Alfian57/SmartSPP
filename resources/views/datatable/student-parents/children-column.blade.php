<div>
    @if ($children->isEmpty())
        <p class="text-danger">Tidak ada anak</p>
    @else
        @foreach ($children as $child)
            <p>{{ $loop->iteration }}. {{ $child->nama }}</p>
        @endforeach
    @endif
</div>
