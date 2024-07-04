@section('title')
    Informasi Tagihan
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Informasi Tagihan" desc="Semua data informasi tagihan milik anda">
        <x-dashboard::ui.page-header.item label="Informasi Tagihan" active />
    </x-dashboard::ui.page-header>

    <x-dashboard::ui.card>
        <div class="d-flex justify-content-between align-items-center">
            @if ($student == null)
                <h5>Siswa belum ada</h5>
            @else
                <h5>Tagihan {{ $student->nama }}</h5>
            @endif

            <form action="{{ route('dashboard.bill-informations.index') }}" method="GET" class="d-flex">
                <label for="student">Pilih Siswa : </label>
                <select name="student" class="form-control " id="student" onchange="this.form.submit()">
                    @foreach ($children as $child)
                        <option value="{{ $child->id }}" {{ $child->id == $student->id ? 'selected' : '' }}>
                            {{ $child->nama }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <livewire:bill-information-table :student="$student" />
    </x-dashboard::ui.card>
</x-dashboard-layouts::main>
