@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Admin" desc="Semua data admin yang tersedia">
        <x-dashboard::ui.page-header.item label="Admin" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-end mb-3">
            <x-dashboard::ui.button href="{{ route('dashboard.admins.create') }}">
                Tambah Admin
            </x-dashboard::ui.button>
        </div>

        @if ($admins->isEmpty())
            <x-dashboard::shared.no-data />
        @else
            <x-dashboard::ui.table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Admin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <x-dashboard::ui.table.table-iteration iteration="{{ $loop->iteration }}" />
                            <td>{{ $admin->name }}</td>
                            <td>
                                <x-dashboard::ui.table.table-edit-action
                                    href="{{ route('dashboard.admins.edit', $admin->id) }}" />
                                <x-dashboard::ui.table.table-delete-action
                                    href="{{ route('dashboard.admins.destroy', $admin->id) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard::ui.table>
            {{ $admins->links() }}
        @endif

    </x-dashboard::ui.card>
@endsection
