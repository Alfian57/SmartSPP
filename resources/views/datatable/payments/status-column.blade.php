<div class="font-weight-bold text-capitalize">

    @if ($status == 'pending')
        <p class="text-primary">Diproses</p>
    @elseif($status == 'validated')
        <p class="text-success">Diterima</p>
    @else
        <p class="text-danger">Ditolak</p>
    @endif

</div>
