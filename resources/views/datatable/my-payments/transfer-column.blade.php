<div>
    @if ($image)
        <img src="{{ asset('storage/' . $image) }}" alt="image" style="width: 50px">
    @else
        <p>Tidak ada</p>
    @endif
</div>
