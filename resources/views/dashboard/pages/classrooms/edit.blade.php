@section('title')
    Edit Kelas
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Kelas" desc="Semua data kelas yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.classrooms.index') }}" label="Kelas" />
        <x-dashboard::ui.page-header.item label="Ubah" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Kelas">
        <form action="{{ route('dashboard.classrooms.update', $classroom->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-dashboard::ui.input label="Nama" name="name" value="{{ old('name', $classroom->name) }}"
                placeholder="Masukan Nama Kelas" required />

            <div class="d-flex justify-content-end">
                <x-dashboard::ui.button type="submit">
                    Kirim
                </x-dashboard::ui.button>
            </div>
        </form>
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
