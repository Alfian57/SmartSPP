<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h5>{{ $title }}</h5>
                    <span>{{ $desc }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">
                            <i class="ik ik-home"></i>
                        </a>
                    </li>
                    {{ $slot }}
                </ol>
            </nav>
        </div>
    </div>
</div>
