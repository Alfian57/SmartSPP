@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Informasi Tagihan" desc="Semua data informasi tagihan milik anda">
        <x-dashboard::ui.page-header.item label="Informasi Tagihan" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <livewire:bill-information-table />
    </x-dashboard::ui.card>
@endsection
