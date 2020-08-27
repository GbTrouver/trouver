<!doctype html>
<html lang="en">


<!-- Mirrored from demo.dashboardpack.com/architectui-html-free/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2020 03:28:02 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Trouver Admin Panel - Login</title>
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
{{-- @stack('page_css') --}}
<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        {{-- @include('admin.layouts.header') --}}
        <div class="app-main">
            {{-- @include('admin.layouts.sidebar') --}}
            <div class="app-main__outer">
                {{-- @yield('content') --}}
                {{-- @include('admin.layouts.footer') --}}

                <div class="app-main__inner">
                    <div class="main-card col-md-6 card mx-auto">
                        <div class="card-header">
                            <h5><strong>Login</strong></h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                               <div class="alert alert-success alert-dismissible">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                   <strong>{{ session('success') }}</strong>
                               </div>
                            @endif
                            @if (session('error'))
                               <div class="alert alert-danger alert-dismissible">
                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                   <strong>{{ session('error') }}</strong>
                               </div>
                            @endif
                            {{-- <h5 class="card-title">Special Title Treatment</h5>With supporting text below as a natural lead-in to additional content.
                            <br><br>
                            <button class="btn btn-warning">Go somewhere</button> --}}
                            <form action="{{ route('admin.login_post') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" placeholder="Enter Your Email" class="form-control">
                                            <span id="email_err" style="color: red; font-weight:700;">
                                                <small class="text-danger"><strong>{{ $errors->first('email') }}</strong></small>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control">
                                            <span id="password_err" style="color: red; font-weight:700;">
                                                <small class="text-danger"><strong>{{ $errors->first('password') }}</strong></small>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-lg btn-success">Login</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="reset" name="cancel" class="btn btn-lg btn-danger"> Cancel</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <div class="form-group">
                                            <a href="#">Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="card-footer">Footer</div> --}}
                    </div>
                </div>

                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('assets/admin/js/main.js') }}"></script>
    {{-- @stack('page_js') --}}
</body>
</html>
