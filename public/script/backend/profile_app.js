"use strict";
//Class Definition
// SYSTEM INFO
function loadSiteInfo_pages() {
    _blockUiPages(1);
    $.ajax({
        url: base_url+ "app_admin/settings/load_profileapps/",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            _blockUiPages(0), $('#col-formSite .card-header .card-title').html(`<h3 class="card-label"><i class="la la-edit text-dark"></i> Form Edit Webiste Info Alumni POLTRADA</h3>`);
            $('[name="id"]').val(data.siteInfo.id);
            $('#name_site').val(data.siteInfo.name_site);
            $('#desk_site').val(data.siteInfo.desk_site);
            $('#keyword_site').val(data.siteInfo.keyword_site);
            //Tagify
            var keywordsite = document.getElementById('keyword_site');
            new Tagify(keywordsite, {
                maxTags: 10,
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
            });
            keywordsite.addEventListener('change', onChange)
            function onChange(e){
                // outputs a String
                //console.log(e.target.value)
            }
            $('#name_instansi').val(data.siteInfo.name_instansi);
            $('#subname_instansi').val(data.siteInfo.subname_instansi);
            $('#telp_site').val(data.siteInfo.telp_site);
            $('#email_site').val(data.siteInfo.email_site);
            $('#wa_site').val(data.siteInfo.wa_site);
            $('#facebook_site').val(data.siteInfo.facebook_site);
            $('#instagram_site').val(data.siteInfo.instagram_site);
            $('#twitter_site').val(data.siteInfo.twitter_site);
            //CopyRight Input
            $('#copyright_site').summernote({
                placeholder: 'Isi copyright website...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']], ['insert', ['link']], ['view', ['codeview']]
                ],
                height: 100, minHeight: null, maxHeight: null, dialogsInBody: false, focus: false, popatmouse: false
            });
            //Summernote CopyRight
            var copyright_site = data.siteInfo.copyright_site;
            $('#copyright_site').summernote('code', copyright_site);
            //File
            load_file_site(data.url_logoinstansi, '#logo_instansi'), load_file_site(data.url_logopublichead, '#logo_public_head'), load_file_site(data.url_backgroundlogin, '#background_login'), load_file_site(data.url_logobackendhead, '#logo_backend_head');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            _blockUiPages(0), console.log('Load data error!');
        }
    });
};
//Load File Site
function load_file_site(url_file, paramDiv) {
    if (url_file == "") {
        var drEvent1 = $(paramDiv).dropify({
            defaultFile: '',
            messages: {
                default: 'Drag atau drop untuk memilih file!',
                replace: '<h3 class="text-light">Ganti file</h3>',
                remove: 'Hapus',
                error: 'error!'
            }
        });
        drEvent1 = drEvent1.data('dropify');
        drEvent1.resetPreview();
        drEvent1.clearElement();
        drEvent1.settings.defaultFile = '';
        drEvent1.destroy();
        drEvent1.init();
    } else {
        var drEvent1 = $(paramDiv).dropify({
            defaultFile: url_file,
            messages: {
                default: 'Drag atau drop untuk memilih file!',
                replace: '<h3 class="text-light">Ganti file</h3>',
                remove: 'Hapus',
                error: 'error!'
            }
        });
        drEvent1 = drEvent1.data('dropify');
        drEvent1.resetPreview();
        drEvent1.clearElement();
        drEvent1.settings.defaultFile = url_file;
        drEvent1.destroy();
        drEvent1.init();
    }
}
//Class Initialization
jQuery(document).ready(function() {
    loadSiteInfo_pages();
});
//Save System Info
$('#btn-save').click(function (e) {
    e.preventDefault();
    $('#btn-save').addClass('spinner spinner-dark spinner-right').html('Menyimpan data...').attr('disabled', true);
    _blockUiPages(1);

    var url;
    var name_site = $('#name_site');
    var desk_site = $('#desk_site');
    var keyword_site = $('#keyword_site');
    var name_instansi = $('#name_instansi');
    var subname_instansi = $('#subname_instansi');
    var telp_site = $('#telp_site');
    var email_site = $('#email_site');
    var wa_site = $('#wa_site');
    var facebook_site = $('#facebook_site');
    var instagram_site = $('#instagram_site');
    var twitter_site = $('#twitter_site');
    var copyright_site = $('#copyright_site');

    var logo_instansi = $('#logo_instansi');
    var logoinstansi_preview = $('#fg-logoinstansi .dropify-preview .dropify-render').html();
    var background_login = $('#background_login');
    var logo_public_head = $('#logo_public_head');
    var logopublichead_preview = $('#fg-logopublichead .dropify-preview .dropify-render').html();
    var backgroundlogin_preview = $('#fg-backgroundlogin .dropify-preview .dropify-render').html();
    var logo_backend_head = $('#logo_backend_head');
    var logobackendhead_preview = $('#fg-logobackendhead .dropify-preview .dropify-render').html();

    if (name_site.val() == '') {
        toastr.error('Nama website masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        name_site.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (desk_site.val() == '') {
        toastr.error('Deskripsi website masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        desk_site.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (keyword_site.val() == '') {
        toastr.error('Kata kunci/ keyword website masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        keyword_site.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (name_instansi.val() == '') {
        toastr.error('Nama instansi masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        name_instansi.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (subname_instansi.val() == '') {
        toastr.error('Sub nama instansi masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        subname_instansi.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (telp_site.val() == '') {
        toastr.error('No. Telp/ Hp instansi masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        telp_site.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (email_site.val() == '') {
        toastr.error('Email instansi masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        email_site.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (!validateEmail(email_site.val())) {
        toastr.error('Email instansi tidak sesuai, contoh: sampleemail@gmail.com', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        email_site.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (wa_site.val() == '') {
        toastr.error('No. WhatsApp instansi masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        wa_site.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (facebook_site.val() == '') {
        toastr.error('Facebook instansi masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        facebook_site.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (instagram_site.val() == '') {
        toastr.error('Instagram instansi masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        instagram_site.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (twitter_site.val() == '') {
        toastr.error('Twitter instansi masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        twitter_site.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (copyright_site.summernote('isEmpty')) {
        toastr.error('Copyright website masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        copyright_site.summernote('focus');
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (logoinstansi_preview == '') {
        toastr.error('Logo instansi masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        $('#fg-logoinstansi .dropify-wrapper').addClass('file-input-error').stop().delay(2500).queue(function () {
            $(this).removeClass('file-input-error');
        });
        logo_instansi.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (logopublichead_preview == '') {
        toastr.error('Logo publik (header) masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        $('#fg-logopublichead .dropify-wrapper').addClass('file-input-error').stop().delay(2500).queue(function () {
            $(this).removeClass('file-input-error');
        });
        logo_public_head.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (backgroundlogin_preview == '') {
        toastr.error('Background login masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        $('#fg-backgroundlogin .dropify-wrapper').addClass('file-input-error').stop().delay(2500).queue(function () {
            $(this).removeClass('file-input-error');
        });
        background_login.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (logobackendhead_preview == '') {
        toastr.error('Logo backend (header) masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        $('#fg-logobackendhead .dropify-wrapper').addClass('file-input-error').stop().delay(2500).queue(function () {
            $(this).removeClass('file-input-error');
        });
        logo_backend_head.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }

    url = base_url+ "app_admin/settings/profileapps_update";
    var formData = new FormData($('#form-site')[0]);
    $.ajax({
        url: url,
        headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
            _blockUiPages(0);
            if (data.status==true){
                Swal.fire({
                    title: "Success!", text: "Informasi website berhasil diperbarui...", icon: "success"
                }).then(function (result) {
                    // load profile app
                    loadSiteInfo_pages();
                });
            }else{
                if(data.pesan_code=='format_inputan') {   
                    Swal.fire({title: "Ooops!", text: data.pesan_error[0], icon: "warning", allowOutsideClick: false});  
                } else {
                    Swal.fire("Ooops!", "Gagal melakukan proses data, mohon cek kembali isian pada form yang tersedia.", "error");  
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
            _blockUiPages(0);
            Swal.fire({title: "Ooops!", text: "Terjadi kesalahan yang tidak diketahui, mohon hubungi pengembang.", icon: "error"
            }).then(function (result) {
                console.log('Load data form is error!');
            });
        }
    });
});