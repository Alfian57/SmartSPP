<div class="d-flex align-items-center">
    <a class="btn btn-primary" target="_blank" href="{{ asset('storage/' . $file) }}">
        Lihat Bukti
    </a>

    @if ($status != 'validated')
        <form action="{{ route('dashboard.payments.accept', $id) }}" method="post" class="mx-1">
            @csrf
            <button type="submit" class="btn btn-success"
                onclick="return confirmation(event, 'Apakah anda ingin menerima pembayaran ini?')"
                href="">Terima</button>
        </form>
    @endif

    @if ($status != 'unvalidated')
        <form action="{{ route('dashboard.payments.reject', $id) }}" method="post" class="mx-1">
            @csrf
            <button type="submit" class="btn btn-danger"
                onclick="return confirmation(event, 'Apakah anda ingin menolak pembayaran ini?')"
                href="">Tolak</button>
        </form>
    @endif
</div>
