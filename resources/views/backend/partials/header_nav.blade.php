<!--begin::Bottom-->
<div class="header-bottom">
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
                <ul class="menu-nav">
                    <li class="menu-item menu-item-dashboard {{ strtolower($activeMenu) == 'dashboard' ? 'menu-item-here' : '' }}" aria-haspopup="true">
                        <a href="{{ url('app_admin/dashboard') }}" class="menu-link mb-1">
                            <span class="svg-icon menu-icon"><i class="flaticon-home-1"></i></span><span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item menu-item-dashboard {{ strtolower($activeMenu) == 'data_alumni' ? 'menu-item-here' : '' }}" aria-haspopup="true">
                        <a href="{{ url('app_admin/data-alumni') }}" class="menu-link mb-1">
                            <span class="svg-icon menu-icon"><i class="bi bi-people"></i></span><span class="menu-text">Data Alumni</span>
                        </a>
                    </li>
                    <li class="menu-item menu-item-dashboard {{ strtolower($activeMenu) == 'report_tracer_study' ? 'menu-item-here' : '' }}" aria-haspopup="true">
                        <a href="{{ url('app_admin/report_tracer_study') }}" class="menu-link mb-1">
                            <span class="svg-icon menu-icon"><i class="bi bi-file-earmark-post"></i></span><span class="menu-text">Report Tracer Study</span>
                        </a>
                    </li>
                    <li class="menu-item menu-item-dashboard {{ strtolower($activeMenu) == 'kegiatan' ? 'menu-item-here' : '' }}" aria-haspopup="true">
                        <a href="{{ url('app_admin/kegiatan') }}" class="menu-link mb-1">
                            <span class="svg-icon menu-icon"><i class="far fa-images"></i></span><span class="menu-text">Kegiatan</span>
                        </a>
                    </li>
                    <li class="menu-item menu-item-pengelolaanwebsite menu-item-submenu menu-item-rel {{ strtolower($activeSubMenu) == 'settings' ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:void(0);" class="menu-link menu-toggle mb-1 ">
                            <span class="svg-icon menu-icon"><i class="fas fa-tools"></i></span>
                            <span class="menu-text">Pengaturan</span><span class="menu-desc"></span><i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-left" data-hor-direction="menu-submenu-left">
                            <ul class="menu-subnav">
                                <li class="menu-item submenu-item-banners {{ strtolower($activeMenu) == 'banner' ? 'menu-item-here' : '' }}" aria-haspopup="true">
                                    <a href="{{ url('app_admin/settings/banner') }}" class="menu-link mb-1">
                                        <span class="svg-icon menu-icon">
                                            <i class="bi bi-aspect-ratio"></i>
                                        </span>
                                        <span class="menu-text">Banner</span>
                                    </a>
                                </li>
                                <li class="menu-item submenu-item-websiteinfo {{ strtolower($activeMenu) == 'profile_app' ? 'menu-item-here' : '' }}" aria-haspopup="true">
                                    <a href="{{ url('app_admin/settings/profileapps') }}" class="menu-link mb-1">
                                        <span class="svg-icon menu-icon">
                                            <i class="flaticon2-website"></i>
                                        </span>
                                        <span class="menu-text">Website Info</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
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