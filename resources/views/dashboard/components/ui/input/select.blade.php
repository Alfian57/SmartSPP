<div class="row form-group">
    <div class="col-12">
        <label for="{{ $name }}">{{ $label }}</label>
    </div>
    <div class="col-12">
        <select class="form-control form-select" name="{{ $name }}">
            @foreach ($options as $key => $value)
                <option value="{{ $key }}" @selected($selected == $key)>{{ $value }}</option>
            @endforeach
        </select>
        @error($name)
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
