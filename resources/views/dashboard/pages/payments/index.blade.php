@section('title')
    Manajemen Pembayaran
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Pembayaran" desc="Semua data pembayaran yang tersedia">
        <x-dashboard::ui.page-header.item label="Pembayaran" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <livewire:payment-table />
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
