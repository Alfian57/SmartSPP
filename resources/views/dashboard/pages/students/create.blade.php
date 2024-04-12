@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Siswa" desc="Semua data siswa yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.students.index') }}" label="Siswa" />
        <x-dashboard::ui.page-header.item label="Tambah" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Siswa">
        <form action="{{ route('dashboard.students.store') }}" method="POST">
            @csrf
            <x-dashboard::ui.input.text type="email" label="Email" name="email" value="{{ old('email') }}"
                placeholder="Masukan Email" required />

            <x-dashboard::ui.input.text type="text" label="NISN" name="nisn" value="{{ old('nisn') }}"
                placeholder="Masukan NISN" required />

            <x-dashboard::ui.input.text type="text" label="Nama" name="name" value="{{ old('name') }}"
                placeholder="Masukan Nama" required />

            <x-dashboard::ui.input.select label="Jenis Kelamin" name="gender" :options="['male' => 'Laki-laki', 'female' => 'Perempuan']" :selected="old('gender')"
                required />

            <x-dashboard::ui.input.text type="date" label="Tanggal Lahir" name="date_of_birth"
                value="{{ old('date_of_birth') }}" placeholder="Masukan Tanggal Lahir" required />

            <x-dashboard::ui.input.select label="Agama" name="religion" :options="[
                'islam' => 'Islam',
                'christianity' => 'Kristen',
                'catholicism' => 'Katolik',
                'hinduism' => 'Hindu',
                'buddhism' => 'Buddha',
                'confucianism' => 'Konghucu',
            ]" :selected="old('religion')" required />

            <x-dashboard::ui.input.select label="Status Yatim" name="orphan_status" :options="[
                'orphan_both' => 'Yatim',
                'orphan_father' => 'Piatu',
                'orphan_mother' => 'Yatim Piatu',
                'none' => 'Bukan Ketiganya',
            ]" :selected="old('orphan_status')"
                required />

            <x-dashboard::ui.input.text type="text" label="Nomor Telepon" name="phone_number"
                value="{{ old('phone_number') }}" placeholder="Masukan Nomor Telepon" required />

            <x-dashboard::ui.input.text-area label="Alamat" name="address" value="{{ old('address') }}"
                placeholder="Masukan Alamat"required />

            <x-dashboard::ui.input.select label="Kelas" name="classroom_id" :options="$classrooms" :selected="old('classroom_id')" required />

            <x-dashboard::ui.input.select label="Orang Tua" name="student_parent_id" :options="$studentParents" :selected="old('student_parent_id')"
                required />

            <x-dashboard::shared.note.create-account />

            <x-dashboard::ui.button.submit>
                Kirim
            </x-dashboard::ui.button.submit>
        </form>
    </x-dashboard::ui.card>
@endsection
