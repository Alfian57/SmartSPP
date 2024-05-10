@section('title')
    Manajemen
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Informasi Tagihan" desc="Semua data informasi tagihan milik anda">
        <x-dashboard::ui.page-header.item label="Informasi Tagihan" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <livewire:bill-information-table />
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
