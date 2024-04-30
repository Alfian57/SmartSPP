@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Siswa" desc="Semua data siswa yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.students.index') }}" label="Siswa" />
        <x-dashboard::ui.page-header.item label="Riwayat Tagihan" active />
    </x-dashboard::ui.page-header>


    <div class="row">
        <x-dashboard::ui.table class="col-12 col-lg-6">
            <tr>
                <td>NISN</td>
                <td>{{ $student->nisn }}</td>

                <td>Total Tagihan</td>
                <td>
                    @if ($totalBill > 0)
                        @money($totalBill)
                    @else
                        <span class="text-primary">Tidak Ada<span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>{{ $student->name }}</td>

                <td>Tagihan Lunas</td>
                <td class="text-primary">{{ $paidBills }} Tagihan</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>{{ $student->classroom->name }}</td>

                <td>Tagihan Belum Lunas</td>
                <td class="text-danger">{{ $unpaidBills }} Tagihan</td>
            </tr>
        </x-dashboard::ui.table>
    </div>

    <x-dashboard::ui.card>
        <livewire:student-bill-table :student="$student" />
    </x-dashboard::ui.card>
@endsection
