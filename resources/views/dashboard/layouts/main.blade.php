<!doctype html>
<html class="no-js" lang="id">

<x-dashboard::shared.head />

<body>
    @stack('body-init')
    @include('sweetalert::alert')

    <div class="wrapper">
        <x-dashboard::shared.navbar />
        <div class="page-wrap">
            <x-dashboard::shared.sidebar />
            <div class="main-content">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
            <x-dashboard::shared.footer />
        </div>
    </div>

    <x-dashboard::shared.scripts />
</body>

</html>
