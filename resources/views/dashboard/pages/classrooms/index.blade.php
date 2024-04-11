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

        @if ($classrooms->isEmpty())
            <x-dashboard::shared.no-data />
        @else
            <x-dashboard::ui.table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classrooms as $classroom)
                        <tr>
                            <x-dashboard::ui.table.table-iteration iteration="{{ $loop->iteration }}" />
                            <td>{{ $classroom->name }}</td>
                            <td>
                                <x-dashboard::ui.table.table-edit-action
                                    href="{{ route('dashboard.classrooms.edit', $classroom->id) }}" />
                                <x-dashboard::ui.table.table-delete-action
                                    href="{{ route('dashboard.classrooms.destroy', $classroom->id) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard::ui.table>
            {{ $classrooms->links() }}
        @endif

    </x-dashboard::ui.card>
@endsection
