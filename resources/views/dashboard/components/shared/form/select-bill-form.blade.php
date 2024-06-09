<div>
    <x-dashboard::ui.input.select label="Siswa" name="id_siswa" :options="$studentOptions" :selected="old('id_siswa')"
        wire:model.live="studentId" />

    <x-dashboard::ui.input.select label="Tagihan" name="id_tagihan" :options="$billOptions" :selected="old('id_tagihan')" />
</div>
