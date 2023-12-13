@extends('backend.layouts', ['activeMenu' => 'USER_PROFILE', 'activeSubMenu' => '', 'title' => 'User Profile'])
@section('content')
{{-- <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
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
        Halaman ini berfungsi untuk melakukan pengaturan akun pengguna Sistem Informasi Aset.
    </div>
</div> --}}
<!--end::Notice-->
<!--begin::Row-->
<div class="container">
    <div class="row">
        <div class="col-xl-12" id="col-formUsers">
            <!--begin::Card Form Detail Users-->
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Card header-->
                <div class="card-header card-header-tabs-line nav-tabs-line-3x">
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x" id="dtlProfilUser-tabs">
                            <!--begin::Item-->
                            <li class="nav-item mr-3">
                                <a class="nav-link active" id="tabs-profilUser" data-tabs-content="profilUser" href="javascript:void(0);">
                                    <span class="nav-icon">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo7/dist/assets/media/svg/icons/Design/Layers.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                    <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="nav-text font-size-lg">Profil User</span>
                                </a>
                            </li>
                            <!--end::Item-->
                        </ul>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Form-->
                <form class="form" autocomplete="off" id="form-user">
                    <!--begin::Card body-->
                    <div class="card-body">
                        <div class="tab-content" id="dtlProfilUser-tabsContent">
                            <!--begin::Tab-->
                            <div class="tab-pane show active px-7" id="profilUser" role="tabpanel">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <div class="col-lg-8 offset-lg-2">
                                            <h6 class="text-dark font-weight-bold mb-5"><u>Detail User</u></h6>
                                            <div class="form-group" id="fg-thumbuser">
                                                <label for="thumb_user">Foto Pegawai: </label>
                                                <input type="file" id="thumb_user" name="thumb_user" class="dropify-fr" data-default-file="" disabled="disabled" data-show-remove="false" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M" />
                                            </div>
                                            <div class="separator separator-solid separator-border-2 mt-7 mb-5"></div>
                                            <div class="form-group">
                                                <label for="nama_user">Nama: </label>
                                                <input type="text" id="nama_user" name="nama_user" class="form-control" placeholder="Isi nama user..." readonly >
                                            </div>
                                            <div class="form-group">
                                                <label for="level">LEVEL: </label>
                                                <input type="text" id="level" name="level" class="form-control" readonly >
                                            </div>
                                            <div class="form-group">
                                                <label for="nik_user">NIK: </label>
                                                <input type="text" id="nik_user" name="nik_user" class="form-control" placeholder="Isi nik user..." readonly >
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_user">Alamat: </label>
                                                <textarea id="alamat_user" name="alamat_user" class="form-control" rows="3" style="min-height:50px;max-height:150px;" placeholder="Isi alamat user..." readonly ></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="unit_kerja">Unit Kerja: </label>
                                                <textarea id="unit_kerja" name="unit_kerja" class="form-control" rows="3" style="min-height:50px;max-height:150px;" placeholder="Isi Unit Kerja..." readonly ></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="email_user">Email: </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
                                                    <input type="text" id="email_user" name="email_user" class="form-control" placeholder="Isi email user..." readonly >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Body-->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Card Form Detail Users-->
        </div>
    </div>
</div>
<!--end::Row-->
<!-- Pages-js -->
@section('js')
<script src="{{ asset('/script/backend/user_profile.js') }}"></script>
@stop
@endsection