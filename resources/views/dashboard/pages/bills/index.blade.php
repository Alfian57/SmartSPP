@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Siswa" desc="Semua data siswa yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.students.index') }}" label="Siswa" />
        <x-dashboard::ui.page-header.item label="Riwayat" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <x-dashboard::ui.table class="w-50">
            <tr>
                <td>NISN</td>
                <td>{{ $student->nisn }}</td>

                <td>Total Tagihan</td>
                <td>dsakdkasd</td>
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
                <td class="text-danger">{{ $unverifiedPayments }} Angsuran</td>
            </tr>
        </x-dashboard::ui.table>

        @if ($bills->isEmpty())
            <x-dashboard::shared.no-data />
        @else
            <x-dashboard::ui.table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nominal</th>
                        <th>Bulan</th>
                        <th>Tahun Ajaran</th>
                        <th>Jumlah Bayar Angsuran</th>
                        <th>Jumlah Angsuran Ditolak</th>
                        <th>Sisa Tagihan</th>
                        <th>Diskon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bills as $bill)
                        <tr>
                            <x-dashboard::ui.table.table-iteration iteration="{{ $loop->iteration }}" />
                            <td>
                                @money($bill->nominal)
                            </td>
                            <td>{{ $bill->month }}</td>
                            <td>{{ $bill->school_year }}</td>
                            <td>dasjdksajd</td>
                            <td>dasjdksajd</td>
                            <td>dasjdksajd</td>
                            <td>{{ $bill->disscount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard::ui.table>
            {{ $bills->links() }}
        @endif

    </x-dashboard::ui.card>
@endsection
