@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Orang Tua" desc="Semua data orang tua yang tersedia">
        <x-dashboard::ui.page-header.item label="Orang Tua" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-end mb-3">
            <x-dashboard::ui.button href="{{ route('dashboard.student-parents.create') }}">
                Tambah Orang Tua
            </x-dashboard::ui.button>
        </div>

        @if ($studentParents->isEmpty())
            <x-dashboard::shared.no-data />
        @else
            <x-dashboard::ui.table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Orang Tua</th>
                        <th>Nama Anak</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentParents as $studentParent)
                        <tr>
                            <x-dashboard::ui.table.table-iteration iteration="{{ $loop->iteration }}" />
                            <td>{{ $studentParent->name }}</td>
                            <td>
                                @if ($studentParent->students->isEmpty())
                                    <p class="text-danger">Tidak ada anak</p>
                                @else
                                    @foreach ($studentParent->students as $student)
                                        <p>{{ $loop->iteration }}. {{ $student->name }}</p>
                                    @endforeach
                                @endif

                            </td>
                            <td>{{ $studentParent->phone_number }}</td>
                            <td>
                                <x-dashboard::ui.table.table-edit-action
                                    href="{{ route('dashboard.student-parents.edit', $studentParent->id) }}" />
                                <x-dashboard::ui.table.table-delete-action
                                    href="{{ route('dashboard.student-parents.destroy', $studentParent->id) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard::ui.table>
            {{ $studentParents->links() }}
        @endif

    </x-dashboard::ui.card>
@endsection
