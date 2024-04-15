@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Kelas" desc="Semua data kelas yang tersedia">
        <x-dashboard::ui.page-header.item label="Kelas" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-end mb-3">
            <x-dashboard::ui.button href="{{ route('dashboard.classrooms.create') }}">
                Tambah Kelas
            </x-dashboard::ui.button>
        </div>

        <livewire:classroom-table />

    </x-dashboard::ui.card>
@endsection
