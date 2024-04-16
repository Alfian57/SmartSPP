<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title }} | {{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="/dashboard/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/dashboard/plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="/dashboard/plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="/dashboard/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/dashboard/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/dashboard/plugins/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet"
        href="/dashboard/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="/dashboard/plugins/weather-icons/css/weather-icons.min.css">
    <link rel="stylesheet" href="/dashboard/plugins/c3/c3.min.css">
    <link rel="stylesheet" href="/dashboard/plugins/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/dashboard/plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
    <script src="/dashboard/src/js/vendor/modernizr-2.8.3.min.js"></script>
    <link rel="stylesheet" href="/dashboard/plugins/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="/dashboard/dist/css/theme.min.css">

    @stack('styles')

    <style>
        button {
            height: auto !important;
        }

        #table-perPage {
            padding-right: 8;
            background: none;
        }
    </style>

    @livewireStyles
</head>
