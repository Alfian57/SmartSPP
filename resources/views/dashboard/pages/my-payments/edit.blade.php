@extends('dashboard.layouts.main')

@section('content')
    <x-dashboard::ui.page-header title="Pembayaran" desc="Semua data pembayaran yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.my-bills.payments.index', $bill->id) }}"
            label="Pembayaran" />
        <x-dashboard::ui.page-header.item label="Tambah" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Pembayaran">
        <form action="{{ route('dashboard.my-bills.payments.update', [$bill->id, $payment->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-dashboard::ui.input.text type="number" label="Nominal" name="nominal"
                value="{{ old('nominal', $payment->nominal) }}" placeholder="Masukan Nominal Pembayaran" required />


            <x-dashboard::ui.input.text type="file" label="File Transfer" name="transfer_file" required>
                <div style="width: 100px" class="text-danger mb-3 text-nowrap">
                    <img src="{{ asset('storage/' . $payment->transfer_file) }}" alt="Bukti tidak dapat ditampilkan"
                        class="img-fluid">
                </div>
            </x-dashboard::ui.input.text>
            <p class="text-info">Note: Kosongkan jika tidak ingin mengupdate</p>

            <x-dashboard::ui.button.submit>
                Kirim
            </x-dashboard::ui.button.submit>
        </form>
    </x-dashboard::ui.card>
@endsection
