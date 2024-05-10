<div class="nav-item @if (str_contains(request()->url(), $href)) active @endif">
    <a href="{{ $href }}" wire:navigate>{{ $slot }}</a>
</div>
