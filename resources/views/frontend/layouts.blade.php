<!DOCTYPE html>
@php
$Base_Img = asset('dist/img/');
$profiles = App\Models\ProfileApp::where('id', 1)->first();
@endphp
<html lang="en">
<!--begin::Head-->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="320">
    <meta name="author" content="Yoga Setiawan - Tricipta Internasional">
    <link rel="canonical" href="{{ url('/') }}">
    <title>{{ $title }} - {{ $profiles->subname_instansi }}</title>
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
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Plugins Custom-->
    @include('frontend.partials.styles')
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class=" header-mobile-fixed header-bottom-enabled subheader-enabled page-loading" ng-app="routerApp">
	<!--begin::Main-->
	<!--begin::Header Mobile-->
	<div id="kt_header_mobile" class="header-mobile bg-light header-mobile-fixed">
		<!--begin::Logo-->
		<a href="" class="logoHeaderTopMobile">
			<img alt="Logo" src="{{ $Base_Img }}/statis-placeholder.png" class="max-h-30px" />
		</a>
		<!--end::Logo-->
		<!--begin::Toolbar-->
		<div class="d-flex align-items-center">
			<button class="btn btn-dark p-0 burger-icon burger-icon-left ml-4 mr-3 " id="kt_header_mobile_toggle">
				<span></span>
			</button>
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header Mobile-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">
			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<!--begin::Header-->
				<div id="kt_header" class="header flex-column">
					{{-- @include('frontend.partials.header') --}}
					@include('frontend.partials.header_nav')
                    <div class="header-top bg-dark h-auto w-100">
                        <!--begin::Container-->
                        <div class="container justify-content-center py-2">
                            <!--begin::HeadBanner Center-->
                            <div class="d-none d-lg-flex row">
                                <div class="col-lg-12">
                                    @if((new \Jenssegers\Agent\Agent())->isDesktop())
                                    <!--begin::Banner-->
                                    <a href="" class="" id="sectionBanner">
                                        <img alt="banner" src="{{ asset('dist/img/placeholder_banner.jpg') }}" class="w-100 rounded">
                                    </a>
                                    <!--end::Banner-->
                                    @endif
                                </div>
                            </div>
                            <!--end::HeadBanner Center-->
                        </div>
                        <!--end::Container-->
                    </div>
				</div>
				<!--end::Header-->
				<!--begin::Content-->
				<!--<div class="content d-flex flex-column flex-column-fluid" id="kt_content">-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @yield('content')
                </div>
                <!--end::Content-->
                @include('frontend.partials.footer')
            </div>
        <!--end::Wrapper-->
        </div>
    <!--end::Page-->
    </div>
    <!--end::Main-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <!--begin::Svg Icon | path:/metronic/theme/html/demo7/dist/assets/media/svg/icons/Navigation/Up-2.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                    <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <!--end::Scrolltop-->
    @include('frontend.partials.scripts')
</body>
<!--end::Body-->
</html>