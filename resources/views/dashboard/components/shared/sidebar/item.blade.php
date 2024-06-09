@php
    if (str_contains(request()->url(), $href)) {
        $class = 'nav-item active';
    } else {
        $class = 'nav-item';
    }
@endphp

<div {{ $attributes->class($class) }}>
    <a href="{{ $href }}">{{ $slot }}</a>
</div>
