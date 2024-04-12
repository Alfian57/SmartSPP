<div class="row form-group">
    <div class="col-12">
        <label for="{{ $name }}" class=" form-control-label">{{ $label }}</label>
    </div>
    <div class="col-12">
        <textarea name="{{ $name }}" id="{{ $name }}" rows="9" placeholder="{{ $placeholder }}"
            class="form-control">{{ $value }}</textarea>
        @error($name)
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
