<div class="mx-1 d-inline">
    <form action="{{ $href }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <div class="d-flex text-end">
            <button type="submit" onclick="return confirmation(event, 'Apakah anda ingin menghapus data ini?')"
                class="btn btn-danger rounded">
                Hapus
            </button>
        </div>
    </form>
</div>
