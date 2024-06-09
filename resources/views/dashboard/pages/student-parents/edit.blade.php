@section('title')
    Edit Orang Tua
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Orang Tua" desc="Semua data orang tua yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.student-parents.index') }}" label="Orang Tua" />
        <x-dashboard::ui.page-header.item label="Ubah" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Orang Tua">
        <form action="{{ route('dashboard.student-parents.update', $studentParent->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-dashboard::ui.input label="Email" name="email"
                value="{{ old('email', $studentParent->account->email) }}" placeholder="Masukan Email" disable />

            <x-dashboard::ui.input label="Nama" name="nama" value="{{ old('nama', $studentParent->nama) }}"
                placeholder="Masukan Nama" required />

            <x-dashboard::ui.input label="Nomor Telepon" name="no_telepon"
                value="{{ old('no_telepon', $studentParent->no_telepon) }}" placeholder="Masukan Nomor Telepon"
                required />

            <div class="d-flex justify-content-end">
                <x-dashboard::ui.button type="submit">
                    Kirim
                </x-dashboard::ui.button>
            </div>
        </form>
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
