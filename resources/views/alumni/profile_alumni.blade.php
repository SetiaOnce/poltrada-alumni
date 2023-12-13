@extends('alumni.layouts', ['activeMenu' => 'PROFILE_ALUMNI', 'activeSubMenu' => '', 'title' => 'Profile Saya'])
@section('content')

<div class="container">
    <!--begin::Notice-->
    <div class="alert alert-custom alert-success alert-shadow fade show gutter-b" role="alert">
        <div class="alert-icon">
            <span class="svg-icon svg-icon-light svg-icon-2x">
                <i class="bi bi-megaphone"></i>
            </span>
        </div>
        <div class="alert-text">
            Halaman ini berfungsi untuk mengelola data diri anda...
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
                <form class="form" autocomplete="off" id="form-alumni">
                    <input type="hidden" name="nim">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="nama">Nama: <span class="text-danger">*</span></label>
                                    <input type="text" id="nama" name="nama" class="form-control uppercase" maxlength="100" placeholder="Isi nama lengkap anda..." >
                                </div>
                                <div class="form-group">
                                    <label for=provinsi_id">Provinsi: <span class="text-danger">*</span></label>
                                    <select id="provinsi_id" name="provinsi_id" class="selectpicker form-control required show-tick mr-3" data-live-search="true" title="Pilih Provinsi..."></select>
                                </div>
                                <div class="form-group">
                                    <label for=kabupaten_id">Kabupaten: <span class="text-danger">*</span></label>
                                    <select id="kabupaten_id" name="kabupaten_id" class="selectpicker form-control required show-tick mr-3" data-live-search="true" title="Pilih kabupaten..." disabled="true"></select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat: <span class="text-danger">*</span></label>
                                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Isi alamat anda..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email: <span class="text-danger">*</span></label>
                                    <input type="text" id="email" name="email" class="form-control lowercase" maxlength="120" placeholder="Isi email anda..." >
                                    <small class="form-text text-muted">*) Contoh input : <code> example@gmail.com</code></small>
                                </div>
                                <div class="form-group">
                                    <label for="telp">Telepon/Whatsapp: <span class="text-danger">*</span></label>
                                    <input type="text" id="telp" name="telp" class="form-control onlynumber" maxlength="20" placeholder="Isi no telepon/whatsap anda..." >
                                    <small class="form-text text-muted">*) Input hanya angka : <code> 6281XXXXXXXXX</code></small>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir: <span class="text-danger">*</span></label>
                                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="Isi tanggal lahir kamu..." >
                                    <small class="form-text text-muted">*) Format tanggal : <code> dd/mm/yyyy</code></small>
                                </div>
                                <div class="form-group">
                                    <label for="instansi_kerja">Instansi/Tempat Kerja: <span class="text-danger">*</span></label>
                                    <input type="text" id="instansi_kerja" name="instansi_kerja" class="form-control uppercase" maxlength="100" placeholder="Isi nama tempat kerja anda..." >
                                    <small class="form-text text-muted">*) Contoh Input : <code> KEMENTRIAN PERHUBUNGAN REPUBLIK INDONESIA</code></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" id="btn-save" class="btn btn-sm btn-primary mr-2"><i class="far fa-save"></i> Simpan</button>
                        <button type="button" id="btn-reset" class="btn btn-sm btn-secondary" onclick="loadProfileAlumni();"><i class="flaticon2-refresh-1"></i> Reset</button>
                    </div>
                </form>
            </div>
            <!--end::Card Form Data Users-->
        </div>
    </div>
    <!--end::Row-->
</div>

@section('js')
<script type="text/javascript" src="{{ asset('script/alumni/profile_alumni.js') }}"></script>
@stop
@endsection
