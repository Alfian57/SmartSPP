@section('title')
    Edit Siswa
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Siswa" desc="Semua data siswa yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.students.index') }}" label="Siswa" />
        <x-dashboard::ui.page-header.item label="Ubah" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Siswa">
        <form action="{{ route('dashboard.students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-dashboard::ui.input type="email" label="Email" name="email"
                value="{{ old('email', $student->account->email) }}" placeholder="Masukan Email" disable />

            <x-dashboard::ui.input type="text" label="NISN" name="nisn"
                value="{{ old('nisn', $student->nisn) }}" placeholder="Masukan NISN" required />

            <x-dashboard::ui.input type="text" label="Nama" name="nama"
                value="{{ old('nama', $student->nama) }}" placeholder="Masukan Nama" required />

            <x-dashboard::ui.input.select label="Jenis Kelamin" name="jenis_kelamin" :options="['laki-laki' => 'Laki-laki', 'perempuan' => 'Perempuan']" :selected="old('jenis_kelamin', $student->jenis_kelamin)"
                required />

            <x-dashboard::ui.input type="date" label="Tanggal Lahir" name="tanggal_lahir"
                value="{{ old('tanggal_lahir', $student->tanggal_lahir) }}" placeholder="Masukan Tanggal Lahir"
                required />

            <x-dashboard::ui.input.select label="Agama" name="agama" :options="[
                \App\Enums\Religion::ISLAM->value => 'Islam',
                \App\Enums\Religion::CHRISTIANITY->value => 'Kristen',
                \App\Enums\Religion::CATHOLICISM->value => 'Katolik',
                \App\Enums\Religion::HINDUISM->value => 'Hindu',
                \App\Enums\Religion::BUDDHISM->value => 'Buddha',
                \App\Enums\Religion::CONFUCIANISM->value => 'Konghucu',
            ]" :selected="old('agama', $student->agama)" required />

            <x-dashboard::ui.input.select label="Status Yatim" name="status" :options="[
                \App\Enums\OrphanStatus::YATIM_PIATU->value => 'Yatim Piatu',
                \App\Enums\OrphanStatus::YATIM->value => 'Yatim',
                \App\Enums\OrphanStatus::PIATU->value => 'Piatu',
                \App\Enums\OrphanStatus::NONE->value => 'Tidak Yatim Piatu',
            ]" :selected="old('status', $student->status)"
                required />

            <x-dashboard::ui.input type="text" label="Nomor Telepon" name="no_telepon"
                value="{{ old('no_telepon', $student->no_telepon) }}" placeholder="Masukan Nomor Telepon" required />

            <x-dashboard::ui.input.text-area label="Alamat" name="alamat" placeholder="Masukan Alamat"
                value="{{ old('alamat', $student->alamat) }}" required />

            <x-dashboard::ui.input.select label="Kelas" name="id_kelas" :options="$classrooms" :selected="old('id_kelas', $student->id_kelas)" required />

            <x-dashboard::ui.input.select label="Orang Tua" name="id_orang_tua" :options="$studentParents" :selected="old('id_orang_tua', $student->id_orang_tua)"
                required />

            <div class="d-flex justify-content-end">
                <x-dashboard::ui.button type="submit">
                    Kirim
                </x-dashboard::ui.button>
            </div>
        </form>
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
