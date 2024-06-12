<div class="d-flex align-items-center">
    @if ($file)
        <a class="btn btn-primary" target="_blank" href="{{ asset('storage/' . $file) }}">
            Lihat Bukti
        </a>
    @endif

    @if ($status != 'tervalidasi')
        <form action="{{ route('dashboard.payments.accept', $id) }}" method="get" class="mx-1">
            @csrf
            <button type="submit" class="btn btn-success" href="">Terima</button>
        </form>
    @endif

    @if ($status != 'belum-tervalidasi')
        <form action="{{ route('dashboard.payments.reject', $id) }}" method="post" class="mx-1">
            @csrf
            <button type="submit" class="btn btn-danger"
                onclick="return confirmation(event, 'Apakah anda ingin menolak pembayaran ini?')"
                href="">Tolak</button>
        </form>
    @endif
</div>
