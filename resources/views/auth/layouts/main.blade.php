<!doctype html>
<html class="no-js" lang="id">

<x-auth::shared.head />

<body>
    @include('sweetalert::alert')

    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100 bg-white">
                <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                    <div class="lavalite-bg" style="background-image: url('/dashboard/img/auth/login-bg.jpg')">
                        <div class="lavalite-overlay"></div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <x-auth::shared.scripts />
</body>

</html>
