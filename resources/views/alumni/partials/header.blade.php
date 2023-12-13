<!--begin::Top-->
<div class="header-top bg-dark">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Left-->
        <div class="d-none d-lg-flex align-items-center mr-3">
            <!--begin::Logo-->
            <a href="" class="mr-20 logoHeaderTop">
                <img alt="Logo" src="{{ $Base_Img }}/statis-placeholder.png" class="max-h-35px" />
            </a>
            <!--end::Logo-->
        </div>
        <!--end::Left-->
        <!--begin::Topbar-->
        <div class="topbar bg-dark">
            <!--begin::User-->
            <div class="topbar-item d-none d-lg-flex">
                <div class="btn btn-icon btn-hover-transparent-white w-sm-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <div class="d-flex flex-column text-right pr-sm-3">
                        <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-sm-inline">Username</span>
                        <span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline">Leves</span>
                    </div>
                    <span class="symbol symbol-35">
                        <div class="symbol-label" style="background-image: url('{{ $Base_Img }}/default-user-img.jpg')"></div>
                        <i class="symbol-badge bg-success"></i>
                    </span>
                </div>
            </div>
            <!--end::User-->
            <div class="topbar-item d-none d-lg-flex ml-6">
                <a href="{{ url('app_alumni/logout') }}" data-toggle="tooltip" title="Keluar Dari Sistem!">
                    <div class="btn btn-icon btn-danger btn-sm mr-1" id="kt_quick_panel_toggle">
                        <span class="svg-icon svg-icon-xl svg-icon-danger">
                            <i class="mdi mdi-power"></i>
                        </span>		            
                    </div>
                </a>
            </div>
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
<!--end::Top-->

