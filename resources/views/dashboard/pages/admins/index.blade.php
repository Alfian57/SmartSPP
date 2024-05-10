@section('title')
    Manajemen Admin
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Admin" desc="Semua data admin yang tersedia">
        <x-dashboard::ui.page-header.item label="Admin" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-end mb-3">
            <x-dashboard::ui.button href="{{ route('dashboard.admins.create') }}">
                Tambah Admin
            </x-dashboard::ui.button>
        </div>

        <livewire:admin-table />

    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
