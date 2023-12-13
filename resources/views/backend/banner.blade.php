@extends('backend.layouts', ['activeMenu' => 'BANNER', 'activeSubMenu' => 'settings', 'title' => 'Banner Setting'])
@section('content')
@section('subheader')
<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-1">
        <!--begin::Page Heading-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5 titlePageBreadcrumb"><h5 class="text-dark font-weight-bold my-1 mr-5"><i class="bi bi-aspect-ratio"></i> Kelola Informasi Banner Public</h5></div>
            <!--end::Page Heading-->
        </div>
        <!--end::Page Heading-->
    </div>
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
        <a href="{{ url('app_admin/dashboard') }}" class="text-muted"><i class="flaticon-home-1"></i></a></li>
        <li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Pengaturan</a></li>
        <li class="breadcrumb-item text-muted"><span class="text-muted">Banner</span></li>
    </ul>
    <!--end::Breadcrumb-->
    <!--end::Info-->
</div>
@endsection

<div class="container">
<!--begin::Notice-->
<div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon">
        <span class="svg-icon svg-icon-primary svg-icon-2x">
            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo7/dist/../src/media/svg/icons/Communication/Thumbtack.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24" />
                    <path d="M11.6734943,8.3307728 L14.9993074,6.09979492 L14.1213255,5.22181303 C13.7308012,4.83128874 13.7308012,4.19812376 14.1213255,3.80759947 L15.535539,2.39338591 C15.9260633,2.00286161 16.5592283,2.00286161 16.9497526,2.39338591 L22.6066068,8.05024016 C22.9971311,8.44076445 22.9971311,9.07392943 22.6066068,9.46445372 L21.1923933,10.8786673 C20.801869,11.2691916 20.168704,11.2691916 19.7781797,10.8786673 L18.9002333,10.0007208 L16.6692373,13.3265608 C16.9264145,14.2523264 16.9984943,15.2320236 16.8664372,16.2092466 L16.4344698,19.4058049 C16.360509,19.9531149 15.8568695,20.3368403 15.3095595,20.2628795 C15.0925691,20.2335564 14.8912006,20.1338238 14.7363706,19.9789938 L5.02099894,10.2636221 C4.63047465,9.87309784 4.63047465,9.23993286 5.02099894,8.84940857 C5.17582897,8.69457854 5.37719743,8.59484594 5.59418783,8.56552292 L8.79074617,8.13355557 C9.76799113,8.00149544 10.7477104,8.0735815 11.6734943,8.3307728 Z" fill="#000000" />
                    <polygon fill="#000000" opacity="0.3" transform="translate(7.050253, 17.949747) rotate(-315.000000) translate(-7.050253, -17.949747) " points="5.55025253 13.9497475 5.55025253 19.6640332 7.05025253 21.9497475 8.55025253 19.6640332 8.55025253 13.9497475" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <div class="alert-text">
        Halaman ini berfungsi untuk melakukan pengaturan Banner Alumni POLTRADA.
    </div>
</div>
<!--end::Notice-->
<!--begin::Row-->
<div class="row">
    <div class="col-xl-12" id="col-formSite">
        <!--begin::Card Form Data Users-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title"></div>
            </div>
            <!--begin::Form-->
            <form class="form" autocomplete="off" id="form-site">
                <input type="hidden" name="id">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group" id="fg-bgBanner">
                                <label for="file_banner">Banner: </label>
                                <input type="file" id="file_banner" name="file_banner" class="dropify-fr" data-default-file="" data-show-remove="false" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M" />
                                <span class="form-text text-muted">*) Resolusi file direkomendasikan: <code>1094 x 158 pixels</code></span>
                                <span class="form-text text-muted">*) Type File: <code>*.jpg, *.jpeg, *.png</code> | Size file Maks. <code>2MB</code></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" id="btn-save" class="btn btn-sm btn-primary mr-2"><i class="far fa-save"></i> Simpan</button>
                    <button type="button" id="btn-reset" class="btn btn-sm btn-secondary" onclick="_loadBannerData();"><i class="flaticon2-refresh-1"></i> Reset</button>
                </div>
            </form>
        </div>
        <!--end::Card Form Data Users-->
    </div>
</div>
<!--end::Row-->
<!-- Pages-js -->
</div>

@section('js')
<script type="text/javascript" src="{{ asset('script/backend/banner.js') }}"></script>
@stop
@endsection