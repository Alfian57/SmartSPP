@section('title')
    Manajemen
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Pembayaran" desc="Semua data pembayaran yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.my-bills.payments.index', $bill->id) }}"
            label="Pembayaran" />
        <x-dashboard::ui.page-header.item label="Tambah" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Pembayaran">
        <x-dashboard::ui.table class="w-50 font-weight-bold">
            <tr>
                <td colspan="2">Tujuan Pembarayan</td>
            </tr>
            <tr>
                <td>Kredensial</td>
                <td>{{ config('spp.payment_credentials.payment_destination') }}</td>
            </tr>
            <tr>
                <td>Jenis Pembayaran</td>
                <td>{{ config('spp.payment_credentials.payment_type') }}</td>
            </tr>
        </x-dashboard::ui.table>

        <form action="{{ route('dashboard.my-bills.payments.store', $bill->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <x-dashboard::ui.input type="number" label="Nominal" name="nominal" value="{{ old('nominal') }}"
                placeholder="Masukan Nominal Pembayaran" required />

            <x-dashboard::ui.input type="file" label="File Transfer" name="transfer_file" required />

            <div class="d-flex justify-content-end">
                <x-dashboard::ui.button type="submit">
                    Kirim
                </x-dashboard::ui.button>
            </div>
        </form>
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
