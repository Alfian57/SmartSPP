<div class="d-flex align-items-center">
    @if ($file)
        <a class="btn btn-primary" target="_blank" href="{{ asset('storage/' . $file) }}">
            Lihat Bukti
        </a>
    @else
        <button class="btn btn-primary" disabled>
            Aksi Tidak Tersedia
        </button>
    @endif
</div>
