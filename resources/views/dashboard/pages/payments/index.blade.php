@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Pembayaran" desc="Semua data pembayaran yang tersedia">
        <x-dashboard::ui.page-header.item label="Pembayaran" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        @if ($payments->isEmpty())
            <x-dashboard::shared.no-data />
        @else
            <x-dashboard::ui.table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Siswa</th>
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
                            <td>{{ $payment->bill->student->name }}</td>
                            <td>
                                @money($payment->bill->nominal)
                            </td>

                            <td class="text-danger font-weight-bold">
                                <img src="{{ asset('storage/' . $payment->transfer_file) }}"
                                    alt="Bukti rusak. Minta pihak terkait untuk upload ulang">
                            </td>

                            @if ($payment->status == 'pending')
                                <td class="text-primary font-weight-bold text-capitalize">Diproses</td>
                            @elseif($payment->status == 'validated')
                                <td class="text-success font-weight-bold text-capitalize">Ditermia</td>
                            @else
                                <td class="text-danger font-weight-bold text-capitalize">Ditolak</td>
                            @endif

                            <td>{{ $payment->created_at }}</td>

                            <td class="d-flex">
                                @if ($payment->status != 'validated')
                                    <form action="{{ route('dashboard.payments.accept', $payment->id) }}" method="post"
                                        class="mx-1">
                                        @csrf
                                        <button type="submit" class="btn btn-success" href="">Terima</button>
                                    </form>
                                @endif

                                @if ($payment->status != 'unvalidated')
                                    <form action="{{ route('dashboard.payments.reject', $payment->id) }}" method="post"
                                        class="mx-1">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" href="">Tolak</button>
                                    </form>
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
