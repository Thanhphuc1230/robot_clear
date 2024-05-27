<head>
    <!--=============== basic  ===============-->
    <meta charset="utf-8">
    <title>@yield('module') </title>
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/' . $website->favicon) }}">

    <!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->
    <link rel="preload" href="@yield('images')" as="image">
    <link rel="alternate" hreflang="x-default" href="{{ route('website.home') }}">
    <link rel="alternate" hreflang="vi" href="{{ route('website.home') }}">
    <link rel="canonical" href="{{ request()->fullUrl() }}" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo/' . $website->favicon) }}">
    <!-- fonts -->

    <meta property="og:locale" content="vi_VN">
    <meta property="og:type" content="{{ $website->meta_name }}">
    <meta property="og:site_name" content="{{ $website->meta_name }}">
    <meta property="og:image" content="@yield('images')">
    <meta property="og:image:alt" content="@yield('images')">
    <meta property="og:title" content="@yield('description')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('images')">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">

    <!-- CSS
	============================================ -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('website_style/css/vendor/bootstrap.min.css') }}">
    <!-- Pe-icon-7-stroke CSS -->
    <link rel="stylesheet" href="{{ asset('website_style/css/vendor/pe-icon-7-stroke.css') }}">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="{{ asset('website_style/css/vendor/font-awesome.min.css') }}">
    <!-- Slick slider css -->
    <link rel="stylesheet" href="{{ asset('website_style/css/plugins/slick.min.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('website_style/css/plugins/animate.css') }}">
    <!-- Nice Select css -->
    <link rel="stylesheet" href="{{ asset('website_style/css/plugins/nice-select.css') }}">
    <!-- jquery UI css -->
    <link rel="stylesheet" href="{{ asset('website_style/css/plugins/jqueryui.min.css') }}">
    <!-- main style css -->
    <link rel="stylesheet" href="{{ asset('website_style/css/style.css') }}">

</head>