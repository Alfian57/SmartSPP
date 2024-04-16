<div class="mx-1 d-inline">
    <button type="button" class="btn btn-danger btn-sm rounded" data-toggle="modal"
        data-target="#{{ $href }}-Modal">
        Hapus
    </button>

    @push('body-init')
        <div class="modal fade" id="{{ $href }}-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konformasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ $href }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="d-flex">
                                <button type="button" class="btn btn-secondary mx-1" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger btn-sm rounded mx-1">Ya,
                                    Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush
</div>
