@section('title')
    Tambah Orang Tua
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Orang Tua" desc="Semua data orang tua yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.student-parents.index') }}" label="Orang Tua" />
        <x-dashboard::ui.page-header.item label="Tambah" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Orang Tua">
        <form action="{{ route('dashboard.student-parents.store') }}" method="POST">
            @csrf
            <x-dashboard::ui.input label="Email" name="email" value="{{ old('email') }}" placeholder="Masukan Email"
                required />

            <x-dashboard::ui.input label="Nama" name="name" value="{{ old('name') }}" placeholder="Masukan Nama"
                required />

            <x-dashboard::ui.input label="Nomor Telepon" name="phone_number" value="{{ old('phone_number') }}"
                placeholder="Masukan Nomor Telepon" required />

            <x-dashboard::shared.note.create-account />

            <div class="d-flex justify-content-end">
                <x-dashboard::ui.button type="submit">
                    Kirim
                </x-dashboard::ui.button>
            </div>
        </form>
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
