@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container--default .select2-selection--single {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 0.5rem;
        }

        .select2-selection__arrow {
            margin-top: 5px
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $(".select2").on("select2:selecting", function(e) {
                var value = e.params.args.data.id;
                @this.set('studentId', value);
            });
        });
    </script>
@endpush

<div>
    <x-dashboard::ui.input.select label="Siswa" name="id_siswa" :options="$studentOptions" :selected="old('id_siswa')"
        wire:model.live="studentId" class="select2" />

    <x-dashboard::ui.input.select label="Tagihan" name="id_tagihan" :options="$billOptions" :selected="old('id_tagihan')" />
</div>
