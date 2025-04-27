
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Twitter meta-->


    {{-- <meta property="twitter:card" content="summary_large_image"> --}}
    <meta property="twitter:site" content="@mecbilltech">
    <meta property="twitter:creator" content="@mecbilltech">
    <!-- Open Graph Meta-->
    {{-- <meta property="og:type" content="website">
    <meta property="og:site_name" content="Admin">
    <meta property="og:title" content="School Inventory"> --}}
    {{-- <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png"> --}}
    {{-- <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular."> --}}
    <title>@yield('title')Ogooluwa</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/main.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}font-awesome/css/font-awesome.css">
    <!-- Font-icon css-->
    {{-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->
<!-- Sidebar menu-->

@yield('content')

<!-- Essential javascripts for application to work-->
<script src="{{asset('/')}}js/jquery-3.2.1.min.js"></script>
<script src="{{asset('/')}}js/popper.min.js"></script>
<script src="{{asset('/')}}js/bootstrap.min.js"></script>
<script src="{{asset('/')}}js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('/')}}js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{asset('/')}}js/plugins/chart.js"></script>





@stack('js')
</body>
</html>
