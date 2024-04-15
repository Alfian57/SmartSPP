<div class="d-flex">
    @if ($status != 'validated')
        <form action="{{ route('dashboard.payments.accept', $id) }}" method="post" class="mx-1">
            @csrf
            <button type="submit" class="btn btn-success" href="">Terima</button>
        </form>
    @endif

    @if ($status != 'unvalidated')
        <form action="{{ route('dashboard.payments.reject', $id) }}" method="post" class="mx-1">
            @csrf
            <button type="submit" class="btn btn-danger" href="">Tolak</button>
        </form>
    @endif
</div>
