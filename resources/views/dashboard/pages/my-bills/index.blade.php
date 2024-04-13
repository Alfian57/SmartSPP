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
        </div>

        @if ($student == null or $student->bills->isEmpty())
            <x-dashboard::shared.no-data />
        @else
            <x-dashboard::ui.table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bulan</th>
                        <th>Tahun Ajaran</th>
                        <th>Jumlah Bayar Angsuran</th>
                        <th>Jumlah Angsuran Ditolak</th>
                        <th>Nominal</th>
                        <th>Sisa Tagihan</th>
                        <th>Diskon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->bills as $bill)
                        <tr>
                            <x-dashboard::ui.table.table-iteration iteration="{{ $loop->iteration }}" />

                            <td class="text-capitalize">
                                {{ $bill->month }}
                            </td>

                            <td>{{ $bill->school_year }}</td>
                            <td>{{ $bill->payments->count() }} Kali</td>
                            <td>dasjdksajd</td>
                            <td>
                                @money($bill->nominal)
                            </td>
                            <td>dasjdksajd</td>
                            @if ($bill->discount == 0)
                                <td>Tidak Ada</td>
                            @else
                                <td>
                                    @money($bill->discount)
                                </td>
                            @endif

                            <td>
                                <a href="{{ route('dashboard.my-bills.payments.index', $bill->id) }}"
                                    class="btn btn-primary">Angsuran</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard::ui.table>
        @endif

    </x-dashboard::ui.card>
@endsection
