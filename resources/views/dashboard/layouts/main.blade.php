<!doctype html>
<html class="no-js" lang="id">

<x-dashboard::shared.head />

<body>
    @stack('body-init')
    @include('sweetalert::alert')

    <div class="modal fade" id="laporanModal" tabindex="-1" aria-labelledby="laporanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="laporanModalLabel">Download Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('test') }}">
                        <x-dashboard::ui.input type="date" label="Tanggal awal"
                            placeholder="Masukkan tanggal awal" />
                        <x-dashboard::ui.input type="date" label="Tanggal akhir"
                            placeholder="Masukkan tanggal akhir" />
                        <button type="submit" class="btn btn-primary">Unduh</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="wrapper">
        <x-dashboard::shared.navbar />
        <div class="page-wrap">
            <x-dashboard::shared.sidebar />
            <div class="main-content">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
            <x-dashboard::shared.footer />
        </div>
    </div>

    <x-dashboard::shared.scripts />
</body>

</html>
