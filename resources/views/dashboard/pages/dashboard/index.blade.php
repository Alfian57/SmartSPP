@section('title')
    Manajemen
@endsection

<x-dashboard-layouts::main>
    <div class="row">
        <x-dashboard::ui.card title="Dashboard" class="col-12 col-md-6">
            <div class="text-center">
                <img src="/logo.png" alt="Logo" class="img-fluid w-50">
            </div>
            <h4 class="text-center mt-3">{{ config('app.name') }}</h4>
            <p class="text-center">Jl. Siliwangi, Jombor Lor, Sendangadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa
                Yogyakarta 55285
            </p>
            <p class="text-center">
                Email: {{ config('mail.from.address') }}
                <br>
                Telp: (0274) 623310
            </p>
        </x-dashboard::ui.card>

        <div class="col-12 col-md-6">
            <div class="col-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Siswa</h6>
                                <h2>{{ $studentCount }}</h2>
                            </div>
                            <div class="icon">
                                <x-dashboard::icons.student width="80" height="80" fill="gray" />
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                            aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Kelas</h6>
                                <h2>{{ $classroomCount }}</h2>
                            </div>
                            <div class="icon">
                                <x-dashboard::icons.classroom width="80" height="80" fill="gray" />
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                            aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>SPP Terbayar</h6>
                                <h2>{{ $billCount }}</h2>
                            </div>
                            <div class="icon">
                                <x-dashboard::icons.bill width="80" height="80" fill="gray" />
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                            aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layouts::main>
