@section('title')
    Manajemen Siswa
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Siswa" desc="Semua data siswa yang tersedia">
        <x-dashboard::ui.page-header.item label="Siswa" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-end mb-3">
            <x-dashboard::ui.button href="{{ route('dashboard.students.create') }}">
                Tambah Siswa
            </x-dashboard::ui.button>
        </div>

        <livewire:student-table />

    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
