@section('title')
    Manajemen Orang Tua
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Orang Tua" desc="Semua data orang tua yang tersedia">
        <x-dashboard::ui.page-header.item label="Orang Tua" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-end mb-3">
            <x-dashboard::ui.button href="{{ route('dashboard.student-parents.create') }}">
                Tambah Orang Tua
            </x-dashboard::ui.button>
        </div>

        <livewire:student-parent-table />

    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
