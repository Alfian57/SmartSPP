<div>
    <x-dashboard::ui.input.select label="Siswa" name="student_id" :options="$studentOptions" :selected="old('student_id')"
        wire:model.live="studentId" />

    <x-dashboard::ui.input.select label="Tagihan" name="bill_id" :options="$billOptions" :selected="old('bill_id')" />
</div>
