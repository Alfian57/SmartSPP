@section('title')
    Manajemen Laporan
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Laporan" desc="Semua data laporan yang tersedia">
        <x-dashboard::ui.page-header.item label="Laporan" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Laporan {{ \App\Helpers\Month::translateToID($month) }} {{ $year }}</h5>

            <form action="{{ route('dashboard.reports.index') }}" method="GET" class="d-flex">
                <div class="mx-1">
                    <select name="month" class="form-control " id="month" onchange="this.form.submit()">
                        @foreach (\App\Helpers\Month::all() as $key => $value)
                            <option value="{{ $value }}" {{ $value == $month ? 'selected' : '' }}>
                                {{ $key }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mx-1">
                    <select name="year" class="form-control " id="year" onchange="this.form.submit()">
                        @foreach (range(2021, date('Y')) as $value)
                            <option value="{{ $value }}" @selected($year == $value)>{{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mx-1">
                    <a href="{{ route('dashboard.reports.classroom.export') }}" class="btn btn-primary btn-sm">Download
                        Laporan</a>
                </div>
            </form>
        </div>

        <livewire:report-table :year="$year" :month="$month" />

    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
