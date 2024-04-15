@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Tagihan Saya" desc="Semua data tagihan saya yang tersedia">
        <x-dashboard::ui.page-header.item label="Tagihan Saya" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-between align-items-center">
            @if ($student == null)
                <h5>Siswa belum ada</h5>
            @else
                <h5>Tagihan {{ $student->name }}</h5>
            @endif

            <form action="{{ route('dashboard.my-bills.index') }}" method="GET" class="d-flex">
                <label for="student">Pilih Siswa : </label>
                <select name="student" class="form-control " id="student" onchange="this.form.submit()">
                    @foreach ($children as $child)
                        <option value="{{ $child->id }}" {{ $child->id == $student->id ? 'selected' : '' }}>
                            {{ $child->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <livewire:my-bill-table :student="$student" />

    </x-dashboard::ui.card>
@endsection
