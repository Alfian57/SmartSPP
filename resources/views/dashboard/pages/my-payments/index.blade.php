@section('title')
    Manajemen
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Pembayaran" desc="Semua data pembayaran yang tersedia">
        <x-dashboard::ui.page-header.item label="Pembayaran" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        @if ($bill->status == \App\Enums\BillStatus::NOT_PAID_OFF->value)
            <div class="d-flex justify-content-end mb-3">
                <x-dashboard::ui.button href="{{ route('dashboard.my-bills.payments.create', $bill->id) }}">
                    Ajukan Pembayaran
                </x-dashboard::ui.button>
            </div>
        @endif

        <livewire:my-payment-table :bill="$bill" />

    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
