@extends('backend.layouts', ['activeMenu' => 'KEGIATAN', 'activeSubMenu' => '', 'title' => 'Kegiatan Alumni'])
@section('content')
@section('subheader')
<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-1">
        <!--begin::Page Heading-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5 titlePageBreadcrumb"><h5 class="text-dark font-weight-bold my-1 mr-5"><i class="far fa-images text-dark  mr-1"></i> Kelola Konten Kegiatan Alumni</h5></div>
            <!--end::Page Heading-->
        </div>
        <!--end::Page Heading-->
    </div>
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
        <a href="{{ url('app_admin/dashboard') }}" class="text-muted"><i class="flaticon-home-1"></i></a></li>
        <li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Kegiatan</a></li>
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
        Halaman ini berfungsi untuk mengelola konten kegiatan Alumni POLTRADA.
    </div>
</div>
<!--end::Notice-->
<!--begin::Row-->
<div class="row">
    <div class="col-xl-12" id="card-form" style="display: none;">
        <!--begin::Card Form Data Asesor-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title"></div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <button type="button" class="btn btn-sm btn-success font-weight-bolder mr-3" id="btnShowFoto" style="display: none;"><i class="mdi mdi-folder-multiple-image"></i> Kelola Foto</button>
                    <button type="button" class="btn btn-sm btn-danger font-weight-bolder" id="btnClose" onclick="_closeCard();"><i class="fas fa-times"></i> Tutup</button>
                    <!--end::Button-->
                </div>
            </div>
            <!--begin::Form-->
            <form class="form" id="form-data">
                <input type="hidden" name="id"><input type="hidden" name="methodform_asesor">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-sm-12">
                            <div class="form-group">
                                <label for="judul_kegiatan">Judul: <span class="text-danger">*</span></label>
                                <textarea id="judul_kegiatan" name="judul_kegiatan" class="form-control" maxlength="150" rows="2" style="min-height:50px;max-height:100px;" placeholder="Isi judul konten kegiatan ..." ></textarea>
                                <span id="permalink_text" class="mt-3" style="display: none;"></span>
                                <input type="hidden" name="permalink_galeri" id="permalink_galeri" />
                            </div>
                            <div class="form-group">
                                <label for="isi_kegiatan">Isi: <span class="text-danger">*</span></label>
                                <textarea id="isi_kegiatan" name="isi_kegiatan" class="form-control summernote" ></textarea>
                            </div>
                            <div class="form-group" id="fg-keywordtag_galeri">
                                <label for="keyword_tag_kegiatan">Kata Kunci/ Keyword: <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="keyword_tag_kegiatan" multiple name="keyword_tag_kegiatan[]" placeholder="Isi kata kunci/ keyword konten galeri kegiatan ..."></select>
                                <div class="mt-3 text-muted">*) Maksimal kata kunci sebanyak 25 item.</div>
                            </div>
                            <div class="form-group">
                                <label for="tgl_post_kegiatan">Tgl. Posting: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="flaticon-calendar-1"></i></span>
                                    </div>
                                    <input type="text" id="tgl_post_kegiatan" name="tgl_post_kegiatan" class="form-control" placeholder="Isikan Tgl. posting galeri kegiatan ...">
                                </div>
                                <small class="form-text text-muted">*) Waktu posting mengikuti waktu simpan postingan.</small>
                            </div>
                            <div class="form-group" id="fg-Thumnail">
                                <label for="thumbnail">Thumbnail: <span class="text-danger">*</span></label>
                                <input type="file" id="thumbnail" name="thumbnail" class="dropify-fr" data-default-file="" data-show-remove="false" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M" />
                                <span class="form-text text-muted">*) Type file: <code>*.jpg, *.jpeg, *.png</code></span>
                                <span class="form-text text-muted">*) Size file Maks. <code>2MB</code>Rekomendasi Ukuran : <span class="text-info">H=1339Pixel</span> <span class="text-info">W=887Pixel</span></span>
                            </div>
                            <div class="form-group" id="iGroup-Status" style="display: none;">
                                <label for="status">Status: </label>
                                <select id="status" name="status" class="selectpicker required show-tick form-control" data-style="btn-primary" title="-- Pilih Status Data --" >
                                    <option data-icon="fas fa-toggle-on font-size-lg bs-icon" value="1">Aktif</option>
                                    <option data-icon="fas fa-toggle-off font-size-lg bs-icon" value="0">Tidak Aktif</option>
                                </select>
                                <small class="form-text text-muted">*) Aktif= Tampil; Tidak Aktif= Tidak Tampil;</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-sm-12 text-right">
                            <button type="button" id="btn-save" class="btn btn-sm btn-primary mr-2"><i class="far fa-save"></i> Simpan</button>
                            <button type="button" id="btn-reset" class="btn btn-sm btn-secondary" onclick="_clearForm();"><i class="flaticon2-refresh-1"></i> Batal</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Card Form Data Asesor-->
    </div>
    <div class="col-xl-12" id="col-formSrc" style="display: none;">
        <!--begin::Card Form File SRC Galeri-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title"></div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <button type="button" class="btn btn-sm btn-info font-weight-bolder mr-3" id="btnAddSrc" onclick="addFormSrc();"><i class="mdi mdi-file-image-plus-outline"></i> Tambah Foto</button>
                    <button type="button" class="btn btn-sm btn-danger font-weight-bolder" id="btnCloseSrc" onclick="closeFormSrc('col-dtGaleri');"><i class="fas fa-times"></i> Tutup</button>
                    <!--end::Button-->
                </div>
            </div>
            <!--begin::Form-->
            <form class="form" id="form-srcKegiatan">
                <input type="hidden" name="fid_kegiatan">
                <div class="card-body">
                    <h5 class="mb-5 hideFormSrc"><i class="mdi mdi-file-image-plus text-dark"></i> Form Tambah File Foto</h5>
                    <div class="row justify-content-center hideFormSrc mb-10">
                        <div class="col-lg-8 col-md-10 col-sm-12">
                            <div class="form-group">
                                <label for="caption_filekegiatan">Caption: <span class="text-danger">*</span></label>
                                <input id="caption_filekegiatan" name="caption_filekegiatan" class="form-control" maxlength="50" placeholder="Isi caption foto galeri kegiatan ..." ></input>
                            </div>
                            <div class="form-group" id="fg-filename">
                                <label for="file_name">Foto/Gambar: <span class="text-danger">*</span></label>
                                <input type="file" id="file_name" name="file_name" class="dropify-fr" data-default-file="" data-show-remove="false" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="2M" />
                                <span class="form-text text-muted">*) Type file: <code>*.jpg, *.jpeg, *.png</code></span>
                                <span class="form-text text-muted">*) Size file Maks. <code>2MB</code>Rekomendasi Ukuran : <span class="text-info">H=1339Pixel</span> <span class="text-info">W=887Pixel</span></span>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-10 col-sm-12 text-right">
                            <button type="button" id="btn-saveSrc" class="btn btn-sm btn-primary mr-2"><i class="mdi mdi-upload"></i> Upload</button>
                            <button type="button" id="btn-resetSrc" class="btn btn-sm btn-secondary" onclick="closeAddFormSrc();"><i class="flaticon2-cross"></i> Tutup</button>
                        </div>
                    </div>
                    <div class="mt-5 pt-2 mb-10 separator separator-solid hideFormSrc"></div>
                    <h5 class="mb-5"><i class="mdi mdi-image-multiple-outline text-dark"></i> List File Foto Kegiatan</h3>
                    <div class="row justify-content-center" id="list-srcGaleri"></div>
                </div>
            </form>
        </div>
        <!--end::Card Form File SRC Galeri Kegiatan-->
    </div>
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
                        Data Kegiatan
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <button type="button" class="btn btn-sm btn-primary font-weight-bolder" id="btnAdd" onclick="_addData();"><i class="flaticon2-plus"></i> Tambah</button>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group">
                            <label for="filterDt">Tampilkan: </label>
                            <select id="filterDt" name="filterDt" class="selectpicker required show-tick" data-style="btn-info" title="-- Semua --">
                                <option data-icon="mdi mdi-file-document font-size-lg bs-icon" value="5" selected>Semua</option>
                                <option data-icon="mdi mdi-earth font-size-lg bs-icon" value="1" >Publik</option>
                                <option data-icon="mdi mdi-file font-size-lg bs-icon" value="0">Draft</option>
                                <option data-icon="mdi mdi-delete-variant font-size-lg bs-icon" value="100">Sampah</option>
                            </select>
                        </div>

                        <div class="form-group ml-3">
                            <button type="button" class="btn btn-danger waves-effect waves-light" id="btn-resetDt" name="btn-resetDt"><i class="bi bi-arrow-clockwise"></i> Reset</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="dt-kegiatan" class="table table-hover table-bordered table-head-custom dtr-inline w-100">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center align-middle">No.</th>
                                <th class="align-middle">Judul</th>
                                <th class="align-middle">Kata Kunci/ Tag</th>
                                <th class="align-middle text-center">Views</th>
                                <th class="align-middle text-center">Thumbnail</th>
                                <th class="align-middle text-center">Status</th>
                                <th class="text-center align-middle">Aksi</th>
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

<!--begin Preview Isi Konten Galeri Kegiatan -->
<div class="modal fade" id="previewGaleriModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="scroll scroll-pull" data-scroll="true" data-height="400">
                    <div class="row justify-content-center">
                        <div class="col-lg-12" id="previewGaleri_mdl"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal"><i aria-hidden="true" class="ki ki-close"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--end Preview Isi Konten Galeri Kegiatan -->

@section('js')
<script type="text/javascript" src="{{ asset('script/backend/kegiatan.js') }}"></script>
@stop
@endsection