@section('title')
    {{ $title }}
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Pembayaran" desc="Semua data pembayaran yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.my-bills.payments.index', $bill->id) }}"
            label="Pembayaran" />
        <x-dashboard::ui.page-header.item label="Tambah" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Data Pembayaran">

        <x-dashboard::shared.modal.payment />

        <form action="{{ route('dashboard.my-bills.payments.store', $bill->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <x-dashboard::ui.input type="file" label="File Transfer" name="bukti_transfer" required />

            <div class="d-flex justify-content-end">
                <x-dashboard::ui.button type="submit">
                    Kirim
                </x-dashboard::ui.button>
            </div>
        </form>
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
