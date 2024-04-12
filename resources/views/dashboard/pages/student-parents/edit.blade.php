@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Orang Tua" desc="Semua data orang tua yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.student-parents.index') }}" label="Orang Tua" />
        <x-dashboard::ui.page-header.item label="Ubah" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Orang Tua">
        <form action="{{ route('dashboard.student-parents.update', $studentParent->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-dashboard::ui.input.text label="Email" name="email"
                value="{{ old('email', $studentParent->account->email) }}" placeholder="Masukan Email" disable />

            <x-dashboard::ui.input.text label="Nama" name="name" value="{{ old('name', $studentParent->name) }}"
                placeholder="Masukan Nama" required />

            <x-dashboard::ui.input.text label="Nomor Telepon" name="phone_number"
                value="{{ old('phone_number', $studentParent->phone_number) }}" placeholder="Masukan Nomor Telepon"
                required />

            <x-dashboard::shared.note.create-account />

            <x-dashboard::ui.button.submit>
                Kirim
            </x-dashboard::ui.button.submit>
        </form>
    </x-dashboard::ui.card>
@endsection
