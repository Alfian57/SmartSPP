<div class="font-weight-bold text-capitalize">

    @if ($status == 'menunggu-validasi')
        <p class="text-primary">Diproses</p>
    @elseif($status == 'tervalidasi')
        <p class="text-success">Diterima</p>
    @else
        <p class="text-danger">Ditolak</p>
    @endif

</div>
