@section('title')
    Tagihan Saya
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Tagihan Saya" desc="Semua data tagihan saya yang tersedia">
        <x-dashboard::ui.page-header.item label="Tagihan Saya" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>

        <livewire:my-bill-table />

    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
