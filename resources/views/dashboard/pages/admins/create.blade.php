@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Admin" desc="Semua data admin yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.admins.index') }}" label="Admin" />
        <x-dashboard::ui.page-header.item label="Tambah" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Admin">
        <form action="{{ route('dashboard.admins.store') }}" method="POST">
            @csrf
            <x-dashboard::ui.input.text type="email" label="Email" name="email" value="{{ old('email') }}"
                placeholder="Masukan Email Admin" required />

            <x-dashboard::ui.input.text label="Nama" name="name" value="{{ old('name') }}"
                placeholder="Masukan Nama Admin" required />

            <x-dashboard::shared.note.create-account />

            <x-dashboard::ui.button.submit>
                Kirim
            </x-dashboard::ui.button.submit>
        </form>
    </x-dashboard::ui.card>
@endsection
