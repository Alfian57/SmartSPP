<div>
    @if ($image)
        <img src="{{ asset('storage/' . $file) }}" alt="image" style="width: 50px">
    @else
        <p>Tidak ada</p>
    @endif
</div>
