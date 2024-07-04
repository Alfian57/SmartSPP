@section('title')
    Detail Laporan
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Detail Laporan" desc="Semua data laporan yang tersedia">
        <x-dashboard::ui.page-header.item label="Detail Laporan" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Detail Laporan Kelas {{ $classroom->nama }} {{ \App\Helpers\Month::translateToID($month) }}
                {{ $year }}</h5>

            <form action="{{ route('dashboard.reports.show', $classroom->id) }}" method="GET" class="d-flex">
                <div class="mx-3">
                    <select name="month" class="form-control " id="month" onchange="this.form.submit()">
                        @foreach (\App\Helpers\Month::all() as $key => $value)
                            <option value="{{ $value }}" {{ $value == $month ? 'selected' : '' }}>
                                {{ $key }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="year" class="form-control " id="year" onchange="this.form.submit()">
                        @foreach (range(2021, date('Y')) as $value)
                            <option value="{{ $value }}" @selected($year == $value)>{{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <livewire:report-detail-table :classroom="$classroom" :year="$year" :month="$month" />

    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
