<!doctype html>
<html lang="en">


<!-- Mirrored from demo.dashboardpack.com/architectui-html-free/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2020 03:28:02 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Trouver - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
<link href="{{ asset('assets/admin/css/main.css') }}" rel="stylesheet"></head>
<link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/main-designing.css') }}">
<link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
{{-- <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}"> --}}
@stack('page_css')
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('admin.layouts.header')
        <div class="app-main">
            @include('admin.layouts.sidebar')
            <div class="app-main__outer">
                @yield('content')
                @include('admin.layouts.footer')
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/validations/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/validations/additional-methods.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/main.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        var errors = <?php echo json_encode(Lang::get('errors')); ?>;
    </script>
    @stack('page_js')

    @yield('model')
</body>

</html>
