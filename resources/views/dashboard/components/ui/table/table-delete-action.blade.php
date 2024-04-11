<form action="{{ $href }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm rounded"
        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
</form>
