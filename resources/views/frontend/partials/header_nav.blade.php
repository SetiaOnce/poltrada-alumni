<!--begin::Bottom-->
<div class="header-bottom ">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Header Menu Wrapper-->
        <div class="header-navs header-navs-left" id="kt_header_navs">
            <!--begin:: Navs(for tablet and mobile modes)-->
            <!--begin::Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default justify-content-center">
                <!--begin::Header-->
                <div class="offcanvas-header d-sm-none d-flex align-items-center justify-content-between pb-5 mt-5 ml-10 mr-7">
                    <h3 class="font-weight-bold m-0">Menu </h3>
                    <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_header_mobile_close">
                        <i class="ki ki-close icon-xs text-muted"></i>
                    </a>
                </div>
                <!--end::Header-->
                <div class="separator separator-solid d-sm-none d-flex"></div>
                <!--begin::Nav-->
                <div class="d-none d-lg-flex align-items-center mr-40">
                    <!--begin::Logo-->
                    <a href="" class="mr-20 logoHeaderTop">
                        <img alt="Logo" src="{{ $Base_Img }}/statis-placeholder.png" class="max-h-35px" />
                    </a>
                    <!--end::Logo-->
                </div>
                <ul class="menu-nav">
                    @if ($page == 'beranda')
                        <li class="menu-item menu-item-dashboard {{ strtolower($activeMenu) == 'beranda' ? 'menu-item-here' : '' }}" aria-haspopup="true">
                            <a href="javascript:void(0);" class="menu-link mb-1">
                                <span class="svg-icon menu-icon"><i class="bi bi-house"></i></span><span class="menu-text">Beranda</span>
                            </a>
                        </li>
                        <li class="menu-item menu-item-dashboard" aria-haspopup="true">
                            <a onclick="_cekDataku()" class="menu-link mb-1">
                                <span class="svg-icon menu-icon"><i class="bi bi-search"></i></span><span class="menu-text">Cek Dataku</span>
                            </a>
                        </li>
                        <li class="menu-item menu-item-dashboard {{ strtolower($activeMenu) == 'data_prodi' ? 'menu-item-here' : '' }}" aria-haspopup="true">
                            <a href="javascript:void(0);" onclick="_kegiatan()" class="menu-link mb-1">
                                <span class="svg-icon menu-icon"><i class="bi bi-newspaper"></i></span><span class="menu-text">Kegiatan</span>
                            </a>
                        </li>
                    @else
                        <li class="menu-item menu-item-dashboard {{ strtolower($activeMenu) == 'beranda' ? 'menu-item-here' : '' }}" aria-haspopup="true">
                            <a href="{{ url('/') }}" class="menu-link mb-1">
                                <span class="svg-icon menu-icon"><i class="bi bi-house"></i></span><span class="menu-text">Beranda</span>
                            </a>
                        </li>
                        <li class="menu-item menu-item-dashboard" aria-haspopup="true">
                            <a href="{{ url('/') }}#sectionCekMyData" class="menu-link mb-1">
                                <span class="svg-icon menu-icon"><i class="bi bi-search"></i></span><span class="menu-text">Cek Dataku</span>
                            </a>
                        </li>
                        <li class="menu-item menu-item-dashboard {{ strtolower($activeMenu) == 'data_prodi' ? 'menu-item-here' : '' }}" aria-haspopup="true">
                            <a href="{{ url('') }}#sectionKegiatan" class="menu-link mb-1">
                                <span class="svg-icon menu-icon"><i class="bi bi-newspaper"></i></span><span class="menu-text">Kegiatan</span>
                            </a>
                        </li>
                    @endif
                    @if (\Auth::check())
                        <li class="menu-item menu-item-dashboard" aria-haspopup="true">
                            <a href="{{ url('/app_alumni/dashboard') }}" class="btn btn-success btn-sm menu-link mb-1">
                                <i class="mdi mdi-view-dashboard mr-1"></i> Dashboard
                            </a>
                        </li>
                    @else
                        <li class="menu-item menu-item-dashboard" aria-haspopup="true">
                            <a href="{{ url('/login_alumni') }}" class="btn btn-success btn-sm menu-link mb-1">
                                <i class="bi bi-box-arrow-in-right mr-1"></i> Login
                            </a>
                        </li>
                    @endif
                </ul>
                <!--end::Nav-->
            </div>
            <!--end::Menu-->
            <!--end:: Navs Mobile-->
        </div>
        <!--end::Header Menu Wrapper-->
    </div>
    <!--end::Container-->
</div>
<!--end::Bottom-->