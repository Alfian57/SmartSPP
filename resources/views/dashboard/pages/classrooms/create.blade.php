@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Kelas" desc="Semua data kelas yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.classrooms.index') }}" label="Kelas" />
        <x-dashboard::ui.page-header.item label="Tambah" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Kelas">
        <form action="{{ route('dashboard.classrooms.store') }}" method="POST">
            @csrf
            <x-dashboard::ui.input.text label="Nama" name="name" value="{{ old('name') }}"
                placeholder="Masukan Nama Kelas" />

            <x-dashboard::ui.button.submit>
                Kirim
            </x-dashboard::ui.button.submit>
        </form>
    </x-dashboard::ui.card>
@endsection
