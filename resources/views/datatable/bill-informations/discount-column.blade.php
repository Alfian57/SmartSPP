<div>
    @if ($discount > 0)
        @money($discount)
    @else
        <p class="text-info">Anda tidak memiliki diskon</p>
    @endif
</div>
