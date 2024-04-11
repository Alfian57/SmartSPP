<div class="card">
    @isset($title)
        <div class="card-header d-block">
            <h3>{{ $title }}</h3>
        </div>
    @endisset
    <div class="card-body px-3 table-border-style">
        {{ $slot }}
    </div>
</div>
