@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Siswa" desc="Semua data siswa yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.students.index') }}" label="Siswa" />
        <x-dashboard::ui.page-header.item label="Riwayat Tagihan" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <x-dashboard::ui.table class="w-50">
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

                <td>Angsuran Diproses</td>
                <td class="text-primary">{{ $pendingPayment }} Angsuran</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>{{ $student->classroom->name }}</td>

                <td>Angsuran Ditolak</td>
                <td class="text-danger">{{ $unvalidatedPayments }} Angsuran</td>
            </tr>
        </x-dashboard::ui.table>

        <livewire:student-bill-table :student="$student" />

    </x-dashboard::ui.card>
@endsection
