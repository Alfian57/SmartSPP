@section('title')
    Edit Admin
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Admin" desc="Semua data admin yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.admins.index') }}" label="Admin" />
        <x-dashboard::ui.page-header.item label="Ubah" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Admin">
        <form action="{{ route('dashboard.admins.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-dashboard::ui.input type="email" label="Email" name="email"
                value="{{ old('email', $admin->account->email) }}" placeholder="Masukan Email Admin" disable />

            <x-dashboard::ui.input label="Nama" name="name" value="{{ old('name', $admin->name) }}"
                placeholder="Masukan Nama Admin" required />

            <div class="d-flex justify-content-end">
                <x-dashboard::ui.button type="submit">
                    Kirim
                </x-dashboard::ui.button>
            </div>
        </form>
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
