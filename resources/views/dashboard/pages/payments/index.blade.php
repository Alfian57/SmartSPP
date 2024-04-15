@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Pembayaran" desc="Semua data pembayaran yang tersedia">
        <x-dashboard::ui.page-header.item label="Pembayaran" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <livewire:payment-table />
    </x-dashboard::ui.card>
@endsection
