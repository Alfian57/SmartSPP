<div class="row form-group">
    <div class="col-12">
        <label for="{{ $name }}">{{ $label }}</label>
    </div>
    <div class="col-12">
        <input type="{{ $type ?? 'text' }}" id="{{ $name }}" name="{{ $name }}"
            placeholder="{{ $placeholder }}" value="{{ $value }}" class="form-control">
        @error($name)
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
