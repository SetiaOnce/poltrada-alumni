@php
$profiles = App\Models\ProfileApp::where('id', 1)->first();
$baseAsset = asset('dist/');
@endphp

<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
	<meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="320">
    <meta name="robots" content="index,follow,noodp,noydir">
    <meta name="author" content="Robhi Tranzad - Tricipta Internasional">
    <meta name="webcrawlers" content="all">
    <meta name="rating" content="general">
    <meta name="spiders" content="all">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <title>Login Alumni | {{ $profiles->subname_instansi }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/dist/img/logo/'.$profiles->logo_instansi) }}">
    <meta name="description" content="{{ $profiles->desk_site }}" />
    <meta name="keywords" content="{{ $profiles->keyword_site }}" />
    <meta name="author" content="@Yogasetiaonce" />
    <meta name="email" content="gedeyoga1126@gmail.com" />
    <meta name="website" content="{{ url('/') }}" />
    <meta name="Version" content="1" />
    <meta name="docsearch:language" content="id">
    <meta name="docsearch:version" content="1">
    <link rel="canonical" href="{{ url('/') }}">
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/dist/img/logo/'.$profiles->logo_instansi) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/dist/img/logo/'.$profiles->logo_instansi) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/dist/img/logo/'.$profiles->logo_instansi) }}">
    <link rel="manifest" href="{{ asset('/dist/img/logo/'.$profiles->logo_instansi) }}">
    <link rel="mask-icon" href="{{ asset('/dist/img/logo/'.$profiles->logo_instansi) }}" color="#6CC4A1">
    <meta name="msapplication-TileColor" content="#b91d47">
    <meta name="theme-color" content="#6CC4A1">
    <meta name="application-name" content="{{ $profiles->name_instansi }}">
    <meta name="msapplication-TileImage" content="{{ asset('/dist/img/logo/'.$profiles->logo_instansi) }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="HandheldFriendly" content="true" />
    <!-- Twitter -->
    <meta name="twitter:widgets:csp" content="on">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:site" content="{{ $profiles->name_instansi }}">
    <meta name="twitter:creator" content="@Yogasetiaonce">
    <meta name="twitter:title" content="{{ $profiles->name_instansi }}">
    <meta name="twitter:description" content="{{ $profiles->desk_site }}">
    <meta name="twitter:image" content="{{ asset('/dist/img/logo/'.$profiles->logo_instansi) }}">
    <!-- Facebook -->
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ $profiles->name_instansi }}">
    <meta property="og:description" content="{{ $profiles->desk_site }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('/dist/img/logo/'.$profiles->logo_instansi) }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1000">
    <meta property="og:image:height" content="500">

	<!-- Site Verification -->
	<meta name="google-site-verification" content="">
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Custom Styles(used by this page)-->
	<link href="{{ asset('dist/css/login.init.css?v=7.2.8') }}" rel="stylesheet" type="text/css" />
	<!--end::Page Custom Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="{{ asset('dist/plugins/global/plugins.bundle.css?v=7.2.8') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('dist/css/style.bundle.css?v=7.2.8') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Global BaseUrl-->
	<script src="{{ asset('dist/js/base_route.js?v=7.2.8') }}"></script>
	<!--end::Global BaseUrl-->
	<!--begin::Layout Themes(used by all pages)-->
	<!--end::Layout Themes-->
    <script>
        var BASE_URL = "{{url('/')}}";
    </script> 
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed header-bottom-enabled subheader-enabled page-loading">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat ktdiv_login" style="background: url({{ asset('/dist/img/background-login.jpg') }}) no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover; -o-background-size: cover;  background-size: cover;">
            <div class="bg-overlay"></div>
            <div class="login-form text-center p-7 position-relative overflow-hidden bg-white rounded-sm shadow-sm">
                <!--begin::Login Header-->
                <div class="d-flex flex-center flex-column" id="headPagesLoginInfo"><a href="" title="">
                    <img src="{{ asset('dist/img/statis-placeholder.png') }}" class="max-h-75px" alt="logo-login"></a>
                </div>
                <div class="separator separator-dashed mt-3 mb-10"></div>
                <!--end::Login Header-->

                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-5" id="ttlLogin"></div>
                    <form class="form" id="dt-formLogin">
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Masukkan notar..." id="notar" name="notar" autocomplete="off"/>
                        </div>
                        <div class="form-group mb-5">
                            <div class="input-group input-group-solid">
                                <label class="col-form-label text-right col-lg-3 col-sm-12">Tgl.Lahir</label>
                                <input class="form-control h-auto form-control-solid py-4 px-8 maskTanggal" type="text" placeholder="dd/mm/yyyy" id="tgl_lahir" name="tgl_lahir" autocomplete="off"/>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-between mt-10 mb-0">
                            <a href="{{ url('/login') }}" class="text-dark align-self-center"><i class="mdi mdi-account-arrow-left me-1 align-middle"></i> Login Pengelola</a>
                            <button id="btn-login-submit" class="btn btn-primary font-weight-bold"><i class="fas fa-sign-in-alt"></i> Login</button>
                        </div>
                    </form>
                </div>
                <!--end::Login Sign in form-->
                
            </div>
        </div>
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->

<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('dist/plugins/global/plugins.bundle.js?v=7.2.8') }}"></script>
<script src="{{ asset('dist/js/scripts.bundle.js?v=7.2.8') }}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('script/login/login_alumni.init.js') }}"></script>
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>