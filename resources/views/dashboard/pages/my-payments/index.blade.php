@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Pembayaran" desc="Semua data pembayaran yang tersedia">
        <x-dashboard::ui.page-header.item label="Pembayaran" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-end mb-3">
            <x-dashboard::ui.button href="{{ route('dashboard.my-bills.payments.create', $bill->id) }}">
                Ajukan Pembayaran
            </x-dashboard::ui.button>
        </div>

        @if ($payments->isEmpty())
            <x-dashboard::shared.no-data />
        @else
            <x-dashboard::ui.table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nominal</th>
                        <th>Bukti Transfer</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <x-dashboard::ui.table.table-iteration iteration="{{ $loop->iteration }}" />
                            <td>
                                @money($payment->nominal)
                            </td>

                            <td class="text-danger font-weight-bold">
                                @php
                                    if ($payment->status != 'validated') {
                                        $text = 'Bukti rusak. Silahkan upload ulang';
                                    } else {
                                        $text = 'Bukti rusak';
                                    }
                                @endphp
                                <img src="{{ asset('storage/' . $payment->transfer_file) }}" alt="{{ $text }}"
                                    style="width: 50px">
                            </td>

                            @if ($payment->status == 'pending')
                                <td class="text-primary font-weight-bold text-capitalize">Diproses</td>
                            @elseif($payment->status == 'validated')
                                <td class="text-success font-weight-bold text-capitalize">Diterima</td>
                            @else
                                <td class="text-danger font-weight-bold text-capitalize">Ditolak</td>
                            @endif

                            <td>{{ $payment->created_at }}</td>

                            <td class="d-flex">
                                @if ($payment->status != 'validated')
                                    <div class="mx-1">
                                        <x-dashboard::ui.table.table-edit-action
                                            href="{{ route('dashboard.my-bills.payments.edit', [$bill->id, $payment->id]) }}" />
                                    </div>
                                    <div class="mx-1">
                                        <x-dashboard::ui.table.table-delete-action
                                            href="{{ route('dashboard.my-bills.payments.destroy', [$bill->id, $payment->id]) }}" />
                                    </div>
                                @else
                                    <p class="text-primary">Tidak dapat diedit</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-dashboard::ui.table>
            {{ $payments->links() }}
        @endif

    </x-dashboard::ui.card>
@endsection
