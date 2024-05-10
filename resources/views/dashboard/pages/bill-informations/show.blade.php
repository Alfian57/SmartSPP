@section('title')
    Manajemen
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Informasi Tagihan" desc="Semua data informasi tagihan milik anda">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.bill-informations.index') }}"
            label="Informasi Tagihan" />
        <x-dashboard::ui.page-header.item label="Detail Informasi Tagihan" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <livewire:payment-information-table :bill="$bill" />
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
