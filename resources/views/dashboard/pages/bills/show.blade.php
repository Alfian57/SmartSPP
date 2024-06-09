@section('title')
    Manajemen
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Siswa" desc="Semua data siswa yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.students.index') }}" label="Siswa" />
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.students.bills.index', $bill->student->id) }}"
            label="Riwayat Tagihan" />
        <x-dashboard::ui.page-header.item label="Riwayat Pembayaran" active />
    </x-dashboard::ui.page-header>

    <div class="row">
        <x-dashboard::ui.table class="col-12 col-lg-6">
            <tr>
                <td>Angsuran Diproses</td>
                <td class="text-info">
                    {{ $pendingPayment }} Anguran
                </td>
            </tr>

            <tr>
                <td>Angsuran Diterima</td>
                <td class="text-success">
                    {{ $validatedPayments }} Anguran
                </td>
            </tr>

            <tr>
                <td>Angsuran Ditolak</td>
                <td class="text-danger">
                    {{ $unvalidatedPayments }} Anguran
                </td>
            </tr>
        </x-dashboard::ui.table>
    </div>

    <x-dashboard::ui.card>
        <livewire:student-payment-table :bill="$bill" />
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
