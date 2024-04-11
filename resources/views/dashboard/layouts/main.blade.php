<!doctype html>
<html class="no-js" lang="en">

<x-dashboard::shared.head />

<body>
    <div class="wrapper">
        <x-dashboard::shared.navbar />

        <div class="page-wrap">
            <x-dashboard::shared.sidebar />

            <div class="main-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <x-dashboard::shared.footer />
        </div>

    </div>

    <x-dashboard::shared.scripts />
</body>

</html>
