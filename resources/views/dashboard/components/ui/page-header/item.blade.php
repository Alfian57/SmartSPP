<li class="breadcrumb-item @isset($active) active @endisset">
    <a href="{{ $href ?? '#' }}" wire:navigate>{{ $label }}</a>
</li>
