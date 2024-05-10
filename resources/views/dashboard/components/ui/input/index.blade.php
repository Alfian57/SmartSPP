@props(['label', 'id'])

@php
    $id = $id ?? Str::uuid();
    $name = $attributes->get('name');
@endphp

<div class="row form-group">
    <div class="col-12">
        <label for="{{ $id }}">{{ $label }}</label>
    </div>
    <div class="col-12">
        @isset($body)
            {{ $body }}
        @endisset
    </div>
    <div class="col-12">
        <input
            {{ $attributes->class('form-control ' . ($errors->has($name) ? ' is-invalid' : ''))->merge(['type' => 'text']) }}
            id="{{ $id }}">
        @error($name)
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
