@props(['label', 'id', 'options', 'selected'])

@php
    $id = $id ?? Str::uuid();
    $name = $attributes->get('nama');
@endphp

<div class="row form-group">
    <div class="col-12">
        <label for="{{ $id }}">{{ $label }}</label>
    </div>
    <div class="col-12">
        <select {{ $attributes->class('form-control form-select ' . ($errors->has($name) ? ' is-invalid' : '')) }}
            id="{{ $id }}">
            @foreach ($options as $key => $value)
                <option value="{{ $key }}" @selected($selected == $key)>{{ $value }}</option>
            @endforeach
        </select>
        @error($name)
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
