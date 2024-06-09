@section('title')
    Tambah Admin
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Admin" desc="Semua data admin yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.admins.index') }}" label="Admin" />
        <x-dashboard::ui.page-header.item label="Tambah" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Admin">
        <form action="{{ route('dashboard.admins.store') }}" method="POST">
            @csrf
            <x-dashboard::ui.input type="email" label="Email" name="email" value="{{ old('email') }}"
                placeholder="Masukan Email Admin" required />

            <x-dashboard::ui.input label="Nama" name="nama" value="{{ old('nama') }}"
                placeholder="Masukan Nama Admin" required />

            <x-dashboard::shared.note.create-account />

            <div class="d-flex justify-content-end">
                <x-dashboard::ui.button type="submit">
                    Kirim
                </x-dashboard::ui.button>
            </div>
        </form>
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
