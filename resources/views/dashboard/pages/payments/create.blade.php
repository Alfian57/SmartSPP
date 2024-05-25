@section('title')
    Tambah Pembayaran
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Admin" desc="Semua data pembayaran yang tersedia">
        <x-dashboard::ui.page-header.item href="{{ route('dashboard.payments.index') }}" label="Pembayaran" />
        <x-dashboard::ui.page-header.item label="Tambah" active="" />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card title="Form Tambah Pembayaran">
        <form action="{{ route('dashboard.payments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <x-dashboard::ui.input label="Nominal" name="nominal" value="{{ old('nominal') }}"
                placeholder="Masukan Nominal tervalidasi" required />

            <x-dashboard::ui.input type="file" label="Transfer File" name="transfer_file"
                value="{{ old('transfer_file') }}" placeholder="Masukan File Transfer" required />

            <x-dashboard::ui.input.select label="Status" name="status" :options="['validated' => 'Validated', 'unvalidated' => 'Unvalidated', 'pending' => 'Pending']" :selected="old('status')"
                placeholder="Pilih Status" required />

            <livewire:form.select-bill-form />

            <div class="d-flex justify-content-end">
                <x-dashboard::ui.button type="submit">
                    Kirim
                </x-dashboard::ui.button>
            </div>
        </form>
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
