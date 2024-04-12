@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Siswa" desc="Semua data siswa yang tersedia">
        <x-dashboard::ui.page-header.item label="Siswa" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-end mb-3">
            <x-dashboard::ui.button href="{{ route('dashboard.students.create') }}">
                Tambah Siswa
            </x-dashboard::ui.button>
        </div>

        @if ($students->isEmpty())
            <x-dashboard::shared.no-data />
        @else
            <x-dashboard::ui.table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Nama Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>Total Tagihan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <x-dashboard::ui.table.table-iteration iteration="{{ $loop->iteration }}" />
                            <td>{{ $student->nisn }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->classroom->name }}</td>
                            @if ($student->gender == 'male')
                                <td>Laki-laki</td>
                            @else
                                <td>Perempuan</td>
                            @endif
                            <td class="text-danger">
                                {{-- @money($student->total_bill - $student->total_paid) --}}
                                @money(100000)
                            </td>
                            <td>
                                <a href="{{ route('dashboard.students.bills.index', $student->id) }}"
                                    class="btn btn-primary">Riwayat</a>
                                <x-dashboard::ui.table.table-edit-action
                                    href="{{ route('dashboard.students.edit', $student->id) }}" />
                                <x-dashboard::ui.table.table-delete-action
                                    href="{{ route('dashboard.students.destroy', $student->id) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard::ui.table>
            {{ $students->links() }}
        @endif

    </x-dashboard::ui.card>
@endsection
