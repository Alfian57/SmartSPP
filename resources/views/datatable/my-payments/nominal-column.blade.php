@if ($nominal == null)
    <p class="text-warning">Belum tervalidasi staff</p>
@else
    @money($nominal)
@endif
