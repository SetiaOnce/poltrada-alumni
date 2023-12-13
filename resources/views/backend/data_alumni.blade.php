@extends('backend.layouts', ['activeMenu' => 'DATA_ALUMNI', 'activeSubMenu' => '', 'title' => 'Data Alumni'])
@section('content')
@section('subheader')
<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-1">
        <!--begin::Page Heading-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5 titlePageBreadcrumb"><h5 class="text-dark font-weight-bold my-1 mr-5"><i class="bi bi-people text-dark  mr-1"></i> Kelola Data Alumni</h5></div>
            <!--end::Page Heading-->
        </div>
        <!--end::Page Heading-->
    </div>
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
        <a href="{{ url('app_admin/dashboard') }}" class="text-muted"><i class="flaticon-home-1"></i></a></li>
        <li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Data Alumni</a></li>
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
            Halaman ini berfungsi untuk mengelola Data Alumni POLTRADA.
        </div>
    </div>
    <!--end::Notice-->
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12" id="card-data">
            <!--begin::Card Data Asesor-->
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            <span class="svg-icon svg-icon-dark svg-icon-2x">
                                <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo7/dist/../src/media/svg/icons/Text/Bullet-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000" />
                                        <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            Data Alumni
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <button type="button" class="btn btn-sm btn-success font-weight-bolder" id="btnSincronisasi" onclick="_sincronisasi();"><i class="bi bi-send"></i> Sinkronisasi</button>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <select id="filter-prodi" name="filter-prodi" class="selectpicker required show-tick mr-3" data-live-search="true" title="Filter prodi"></select>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="flaticon-calendar-1"></i></span>
                                    </div>
                                    <input type="text" id="filter-tahun" name="filter-tahun" class="form-control yearpicker" placeholder="Filter Tahun Angkatan" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group ml-3">
                                <button type="button" class="btn btn-danger waves-effect waves-light" id="btn-resetDt" name="btn-resetDt"><i class="bi bi-arrow-clockwise"></i> Reset</button>
                                <button type="button" class="btn btn-secondary waves-effect waves-light" id="export_excel" name="export_excel"><i class="mdi mdi-file-excel"></i> Export Excel</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dt-alumni" class="table table-hover table-bordered table-head-custom dtr-inline w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="align-middle">NAMA</th>
                                    <th class="align-middle">TELEPON</th>
                                    <th class="align-middle">PRODI</th>
                                    <th class="align-middle">NIM</th>
                                    <th class="align-middle">PROVINSI</th>
                                    <th class="align-middle text-center">ANGKATAN</th>
                                    <th class="align-middle">TANGGAL LAHIR</th>
                                    <th class="align-middle">ALAMAT</th>
                                    <th class="align-middle">TEMPAT KERJA</th>
                                    <th class="align-middle text-center">FOTO</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <!--end::Card Data Asesor-->
        </div>
    </div>
    <!--end::Row-->
    <!-- Pages-js -->
</div>

@section('js')
<script type="text/javascript" src="{{ asset('script/backend/data_alumni.js') }}"></script>
@stop
@endsection
