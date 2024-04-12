@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Orang Tua" desc="Semua data orang tua yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.student-parents.index') }}" label="Orang Tua" />
        <x-dashboard::ui.page-header.item label="Tambah" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Orang Tua">
        <form action="{{ route('dashboard.student-parents.store') }}" method="POST">
            @csrf
            <x-dashboard::ui.input.text label="Email" name="email" value="{{ old('email') }}" placeholder="Masukan Email"
                required />

            <x-dashboard::ui.input.text label="Nama" name="name" value="{{ old('name') }}" placeholder="Masukan Nama"
                required />

            <x-dashboard::ui.input.text label="Nomor Telepon" name="phone_number" value="{{ old('phone_number') }}"
                placeholder="Masukan Nomor Telepon" required />

            <x-dashboard::shared.note.create-account />

            <x-dashboard::ui.button.submit>
                Kirim
            </x-dashboard::ui.button.submit>
        </form>
    </x-dashboard::ui.card>
@endsection
