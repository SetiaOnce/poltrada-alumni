"use strict";
//Class Initialization
jQuery(document).ready(function() {
    _loadBannerData();
});
//Class Definition
// SYSTEM INFO
function _loadBannerData() {
    _blockUiPages(1);
    $.ajax({
        url: BASE_URL+ "/ajax/load_banner",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            _blockUiPages(0), $('#col-formSite .card-header .card-title').html(`<h3 class="card-label"><i class="la la-edit text-dark"></i> Form Edit Banner Public</h3>`);
            $('[name="id"]').val(data.dataId);
            //File
            load_file_site(data.url_banner, '#file_banner');
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
//Save System Info
$('#btn-save').click(function (e) {
    e.preventDefault();
    $('#btn-save').addClass('spinner spinner-dark spinner-right').html('Menyimpan data...').attr('disabled', true);
    _blockUiPages(1);

    var url;
    var file_banner = $('#file_banner');
    var banneBg_priview = $('#fg-bgBanner .dropify-preview .dropify-render').html();

    if (banneBg_priview == '') {
        toastr.error('Banner masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        $('#fg-bgBanner .dropify-wrapper').addClass('file-input-error').stop().delay(2500).queue(function () {
            $(this).removeClass('file-input-error');
        });
        file_banner.focus();
        $('#btn-save').removeClass('spinner spinner-dark spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }

    url = BASE_URL+ "/ajax/banner_update";
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
                    title: "Success!", text: "Informasi banner public berhasil diperbarui...", icon: "success"
                }).then(function (result) {
                    // load memeber site
                    _loadBannerData();
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

// reset data
$('#btn-reset').click(function (e){
    e.preventDefault();
    _loadBannerData();
});