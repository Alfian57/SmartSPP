@section('title')
    Tolak Pembayaran
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Admin" desc="Semua data pembayaran yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.payments.index') }}" label="Pembayaran" />
        <x-dashboard::ui.page-header.item label="Tolak" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Tolak Pembayaran">
        <form action="{{ route('dashboard.payments.accept.process', $payment->id) }}" method="POST">
            @csrf

            <img src="{{ asset('storage/' . $payment->transfer_file) }}" alt="Bukti rusak"
                class="img-fluid text-danger font-weight-bold mb-5" style="width: 25%">

            <x-dashboard::ui.input label="Nominal" name="nominal" value="{{ old('nominal') }}"
                placeholder="Masukan Nominal tervalidasi" required />

            <div class="d-flex justify-content-end">
                <x-dashboard::ui.button type="submit">
                    Kirim
                </x-dashboard::ui.button>
            </div>
        </form>
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
