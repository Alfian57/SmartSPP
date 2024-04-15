<div>
    @if ($nominal > 0)
        @money($nominal)
    @else
        <p class="text-warning">Tagihan belum dibayar</p>
    @endif
</div>
