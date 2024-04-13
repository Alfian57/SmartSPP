<div class="nav-item @if (str_contains(request()->url(), $href)) active @endif">
    <a href="{{ $href }}">{{ $slot }}</a>
</div>
