@section('title')
    Manajemen Pembayaran
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Pembayaran" desc="Semua data pembayaran yang tersedia">
        <x-dashboard::ui.page-header.item label="Pembayaran" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-end mb-3">
            <x-dashboard::ui.button href="{{ route('dashboard.payments.create') }}">
                Tambah Pembayaran
            </x-dashboard::ui.button>
        </div>

        <livewire:payment-table />
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
