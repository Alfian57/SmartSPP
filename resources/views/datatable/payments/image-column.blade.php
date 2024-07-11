<div>
    @if ($image)
        <img src="{{ asset('storage/' . $image) }}" alt="Image" class="img-thumbnail" style="width: 50px;">
    @else
        <p style="font-weight: bold">-</p>
    @endif
</div>
