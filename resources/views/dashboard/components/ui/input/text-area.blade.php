@props(['label', 'id', 'value' => ''])

@php
    $id = $id ?? Str::uuid();
    $name = $attributes->get('name');
@endphp

<div class="row form-group">
    <div class="col-12">
        <label for="{{ $id }}" class="form-control-label">{{ $label }}</label>
    </div>
    <div class="col-12">
        <textarea {{ $attributes->class('form-control ' . ($errors->has($name) ? ' is-invalid' : ''))->merge(['rows' => '9']) }}
            id="{{ $id }}">{{ $value }}</textarea>
        @error($name)
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
