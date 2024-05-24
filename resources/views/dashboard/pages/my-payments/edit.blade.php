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

        <x-dashboard::shared.modal.payment />

        <form action="{{ route('dashboard.my-bills.payments.update', [$bill->id, $payment->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-dashboard::ui.input type="file" label="File Transfer" name="transfer_file" required>
                <x-slot name="body">
                    <div style="width: 150px" class="text-danger mb-3 text-nowrap">
                        <img src="{{ asset('storage/' . $payment->transfer_file) }}" alt="Bukti tidak dapat ditampilkan"
                            class="img-fluid">
                    </div>
                </x-slot>

            </x-dashboard::ui.input>
            <p class="text-info">Note: Kosongkan jika tidak ingin mengupdate</p>

            <div class="d-flex justify-content-end">
                <x-dashboard::ui.button type="submit">
                    Kirim
                </x-dashboard::ui.button>
            </div>
        </form>
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
