@extends('backend.layouts', ['activeMenu' => 'PROFILE_APP', 'activeSubMenu' => 'settings', 'title' => 'Site Info'])
@section('content')
@section('subheader')
<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-1">
        <!--begin::Page Heading-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5 titlePageBreadcrumb"><h5 class="text-dark font-weight-bold my-1 mr-5"><i class="flaticon2-website text-dark"></i> Kelola Informasi Website</h5></div>
            <!--end::Page Heading-->
        </div>
        <!--end::Page Heading-->
    </div>
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
        <a href="{{ url('app_admin/dashboard') }}" class="text-muted"><i class="flaticon-home-1"></i></a></li>
        <li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Pengaturan</a></li>
        <li class="breadcrumb-item text-muted"><span class="text-muted">Websites Info</span></li>
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
        Halaman ini berfungsi untuk melakukan pengaturan informasi website Alumni POLTRADA.
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
                            <div class="form-group">
                                <label for="name_site">Nama: <span class="text-danger">*</span></label>
                                <input type="text" id="name_site" name="name_site" class="form-control" maxlength="100" placeholder="Isi nama website..." >
                            </div>
                            <div class="form-group">
                                <label for="desk_site">Deskripsi: <span class="text-danger">*</span></label>
                                <textarea id="desk_site" name="desk_site" class="form-control" maxlength="200" rows="3" style="min-height:50px;max-height:150px;" placeholder="Isi deskripsi website..." ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="keyword_site">Kata Kunci/ Keyword: <span class="text-danger">*</span></label>
                                <input id="keyword_site" class="form-control tagify" name='keyword_site' placeholder="Isi kata kunci/ keyword website...">
                                <div class="mt-3 text-muted">*) Maksimal kata kunci 10.</div>
                            </div>
                            <div class="form-group">
                                <label for="name_instansi">Nama Instansi: <span class="text-danger">*</span></label>
                                <input type="text" id="name_instansi" name="name_instansi" class="form-control" maxlength="100" placeholder="Isi nama instansi..." >
                            </div>
                            <div class="form-group">
                                <label for="subname_instansi">Sub Nama Instansi: <span class="text-danger">*</span></label>
                                <input type="text" id="subname_instansi" name="subname_instansi" class="form-control" maxlength="100" placeholder="Isi Sub nama instansi..." >
                            </div>
                            <div class="form-group">
                                <label for="telp_site">No. Telp/ Hp: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icofont-ui-call"></i></span>
                                    </div>
                                    <input type="text" id="telp_site" name="telp_site" class="form-control" placeholder="Isikan no. telpon/hp instansi...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email_site">Email: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icofont-email"></i></span>
                                    </div>
                                    <input type="text" id="email_site" name="email_site" class="form-control" placeholder="Isikan email instansi...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="wa_site">No. Whatsapp: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icofont-brand-whatsapp"></i></span>
                                    </div>
                                    <input type="text" id="wa_site" name="wa_site" class="form-control" placeholder="Isikan No. whatsapp instansi...">
                                </div>
                                <span class="form-text text-muted">*) Contoh input: <span class="text-info">6282165445854</span></span>
                            </div>
                            <div class="form-group">
                                <label for="facebook_site">Facebook: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                    </div>
                                    <input type="text" id="facebook_site" name="facebook_site" class="form-control" placeholder="Isikan facebook instansi...">
                                </div>
                                <span class="form-text text-muted">*) Contoh input: <span class="text-info">https://www.facebook.com</span></span>
                            </div>
                            <div class="form-group">
                                <label for="instagram_site">Instagram: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                    </div>
                                    <input type="text" id="instagram_site" name="instagram_site" class="form-control" placeholder="Isikan instagram instansi...">
                                </div>
                                <span class="form-text text-muted">*) Contoh input: <span class="text-info">https://www.instagram.com/premcraft2023/?igshid=MzNlNGNkZWQ4Mg%3D%3D</span></span>
                            </div>
                            <div class="form-group">
                                <label for="twitter_site">Twitter: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                    </div>
                                    <input type="text" id="twitter_site" name="twitter_site" class="form-control" placeholder="Isikan instagram instansi...">
                                </div>
                                <span class="form-text text-muted">*) Contoh input: <span class="text-info">https://twitter.com</span></span>
                            </div>
                            <div class="form-group">
                                <label for="copyright_site">Copyright: <span class="text-danger">*</span></label>
                                <textarea id="copyright_site" name="copyright_site" class="form-control" placeholder="Isi copyright website..." ></textarea>
                            </div>
                            <div class="form-group" id="fg-logoinstansi">
                                <label for="logo_instansi">Logo Instansi: <span class="text-danger">*</span></label>
                                <input type="file" id="logo_instansi" name="logo_instansi" class="dropify-fr" data-default-file="" data-show-remove="false" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M" />
                                <span class="form-text text-muted">*) Resolusi file direkomendasikan: <code>512 x 512 pixels</code></span>
                                <span class="form-text text-muted">*) Type File: <code>*.jpg, *.jpeg, *.png</code> | Size file Maks. <code>2MB</code></span>
                            </div>
                            <div class="form-group" id="fg-logopublichead">
                                <label for="logo_public_head">Logo Publik : </label>
                                <input type="file" id="logo_public_head" name="logo_public_head" class="dropify-fr" data-default-file="" data-show-remove="false" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M" />
                                <span class="form-text text-muted">*) Resolusi file direkomendasikan: <code>641 x 91 pixels</code></span>
                                <span class="form-text text-muted">*) Type File: <code>*.jpg, *.jpeg, *.png</code> | Size file Maks. <code>2MB</code></span>
                            </div>
                            <div class="form-group" id="fg-backgroundlogin">
                                <label for="background_login">Background Login: </label>
                                <input type="file" id="background_login" name="background_login" class="dropify-fr" data-default-file="" data-show-remove="false" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M" />
                                <span class="form-text text-muted">*) Resolusi file direkomendasikan: <code>540 x 450 pixels</code></span>
                                <span class="form-text text-muted">*) Type File: <code>*.jpg, *.jpeg, *.png</code> | Size file Maks. <code>2MB</code></span>
                            </div>
                            <div class="form-group" id="fg-logobackendhead">
                                <label for="logo_backend_head">Logo Backend (Header): </label>
                                <input type="file" id="logo_backend_head" name="logo_backend_head" class="dropify-fr" data-default-file="" data-show-remove="false" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M" />
                                <span class="form-text text-muted">*) Resolusi file direkomendasikan: <code>641 x 91 pixels</code></span>
                                <span class="form-text text-muted">*) Type File: <code>*.jpg, *.jpeg, *.png</code> | Size file Maks. <code>2MB</code></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" id="btn-save" class="btn btn-sm btn-primary mr-2"><i class="far fa-save"></i> Simpan</button>
                    <button type="button" id="btn-reset" class="btn btn-sm btn-secondary" onclick="loadSiteInfo_pages();"><i class="flaticon2-refresh-1"></i> Reset</button>
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
<script type="text/javascript" src="{{ asset('script/backend/profile_app.js') }}"></script>
@stop
@endsection