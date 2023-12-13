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
                        <a href="{{ url('app_alumni/dashboard') }}" class="menu-link mb-1">
                            <span class="svg-icon menu-icon"><i class="flaticon-home-1"></i></span><span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item menu-item-dashboard {{ strtolower($activeMenu) == 'profile_alumni' ? 'menu-item-here' : '' }}" aria-haspopup="true">
                        <a href="{{ url('app_alumni/profile-alumni') }}" class="menu-link mb-1">
                            <span class="svg-icon menu-icon"><i class="bi bi-person-circle"></i></span><span class="menu-text">Profile Saya</span>
                        </a>
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