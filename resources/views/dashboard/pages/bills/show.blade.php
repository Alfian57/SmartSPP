@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Siswa" desc="Semua data siswa yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.students.index') }}" label="Siswa" />
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.students.bills.index', $bill->student->id) }}"
            label="Riwayat Tagihan" />
        <x-dashboard::ui.page-header.item label="Riwayat Pembayaran" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <livewire:student-payment-table :bill="$bill" />
    </x-dashboard::ui.card>
@endsection
