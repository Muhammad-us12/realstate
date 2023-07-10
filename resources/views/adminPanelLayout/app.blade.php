<!doctype html>
<html class="no-js" lang="zxx">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Real state</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- <link rel="manifest" href="site.webmanifest"> -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png') }}">
        <!-- Place favicon.ico in the root directory -->

        <!-- CSS here -->
        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/gijgo.css') }}">
        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/slicknav.css') }}">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'">

        <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/style.css') }}">
        <!-- <link rel="stylesheet" href="{{ asset('public/websiteFrontend/css/responsive.css') }}"> -->
    </head>

<body>
    @include('adminPanelLayout.navigation')
      
                {{ $slot }}
    @include('adminPanelLayout.footer')
    </body>
</html>
