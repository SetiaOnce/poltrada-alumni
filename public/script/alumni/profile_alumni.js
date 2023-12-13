"use strict";
//Class Initialization
jQuery(document).ready(function() {
    loadSelectpicker_provinsi();
    $(".onlynumber").mask("0000000000000000");
    //Load Datepicker Input
    $('#tanggal_lahir').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd/mm/yyyy",
        language: "id"
    });
    // input mask lower and upper case
    $('.uppercase').inputmask({casing:'upper'}); 
    $('.lowercase').inputmask({casing:'lower'}); 
    $('#provinsi_id').change(function() {
        var provinsi_id = $(this).val();
        loadSelectpicker_kabupaten(provinsi_id, null);
    });
});
/*************************
    SelectPicker Select provinsi
*************************/
function loadSelectpicker_provinsi() {
    $.ajax({
        url: BASE_URL+ "/select/ajax_getprovinsi",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var output = '';
            var i;
            for (i = 0; i < data.length; i++) {
                output += '<option value="' + data[i].id + '" font-size-lg bs-icon me-3">' + data[i].provinsi + '</option>';
            }
            $('#provinsi_id').html(output).selectpicker('refresh').selectpicker('val', '');
            loadProfileAlumni();
        }, error: function (jqXHR, textStatus, errorThrown) {
            console.log('Load data is error');
        }
    });
}
/*************************
    SelectPicker Select provinsi
*************************/
function loadSelectpicker_kabupaten(provinsi_id, kabupaten_select) {
    $.ajax({
        url: BASE_URL+ "/select/ajax_getkabupaten",
        type: "GET",
        dataType: "JSON",
        data:{
            provinsi_id
        },success: function (data) {
            var output = '';
            var i;
            for (i = 0; i < data.length; i++) {
                output += '<option value="' + data[i].id + '" font-size-lg bs-icon me-3">' + data[i].kabupaten + '</option>';
            }
            $('#kabupaten_id').html(output).selectpicker('refresh').selectpicker('val', '');
            if(kabupaten_select != null){
                $('#kabupaten_id').selectpicker('val', kabupaten_select);
            }
        }, error: function (jqXHR, textStatus, errorThrown) {
            console.log('Load data is error');
        }
    });
}
// load data profile alumni
function loadProfileAlumni() {
    _blockUiPages(1)
    $.ajax({
        url: BASE_URL+ "/app_alumni/ajax/load_profile_alumni",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            _blockUiPages(0)
            $('[name="nim"]').val(data.row.nim);
                
            $('#nama').val(data.row.nama);
            $('#alamat').val(data.row.alamat);
            $('#email').val(data.row.email);
            $('#telp').val(data.row.telp);
            $('#tanggal_lahir').datepicker('update', data.tanggal_lahir),
            $('#instansi_kerja').val(data.row.instansi_kerja);
            
            // handle provinsi
            if(data.row.provinsi_id != 0){
                $('#provinsi_id').selectpicker('val', data.row.provinsi_id);
                loadSelectpicker_kabupaten(data.row.provinsi_id,  data.row.kabupaten_id);
                $('#kabupaten_id').attr('disabled', false);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            _blockUiPages(0), console.log('Load data error!');
        }
    });
};
//Save Profile ALumni
$('#btn-save').click(function (e) {
    e.preventDefault();
    $('#btn-save').addClass('spinner spinner-light spinner-right').html('Menyimpan data...').attr('disabled', true);
    _blockUiPages(1);

    var url;
    var nama = $('#nama');
    var provinsi_id = $('#provinsi_id');
    var kabupaten_id = $('#kabupaten_id');
    var alamat = $('#alamat');
    var email = $('#email');
    var telp = $('#telp');
    var tanggal_lahir = $('#tanggal_lahir');
    var instansi_kerja = $('#instansi_kerja');

    if (nama.val() == '') {
        toastr.error('Nama lengkap masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        nama.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }if (alamat.val() == '') {
        toastr.error('Alamat masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        alamat.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }if (provinsi_id.val() == '') {
        toastr.error('Provinsi masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        provinsi_id.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }if (kabupaten_id.val() == '') {
        toastr.error('Kabupaten masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        kabupaten_id.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }if (email.val() == '') {
        toastr.error('Email masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        email.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }if(!validateEmail(email.val())){
        toastr.error('Format email tidak sesuai contoh: example@gmail.com...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        email.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }if (telp.val() == '') {
        toastr.error('No telepon/whatsapp masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        telp.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }if (tanggal_lahir.val() == '') {
        toastr.error('Tanggal Lahir masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        tanggal_lahir.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }if(!ValidDateFormat(tanggal_lahir.val())){
        toastr.error('Format tanggal lahir tidak sesuai, format (Tanggal/Bulan/Tahun)...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        tanggal_lahir.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }if (instansi_kerja.val() == '') {
        toastr.error('Instansi/tempat kerja masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        instansi_kerja.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }

    url = BASE_URL+ "/app_alumni/ajax/profile_alumni_update";
    var formData = new FormData($('#form-alumni')[0]);
    $.ajax({
        url: url,
        headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
            _blockUiPages(0);
            if (data.status==true){
                Swal.fire({
                    title: "Success!", text: "Profile berhasil diperbarui...", icon: "success"
                }).then(function (result) {
                    // load profile app
                    loadProfileAlumni();
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
            $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
            _blockUiPages(0);
            Swal.fire({title: "Ooops!", text: "Terjadi kesalahan yang tidak diketahui, mohon hubungi pengembang.", icon: "error"
            }).then(function (result) {
                console.log('Load data form is error!');
            });
        }
    });
});
// validate date to (dd/mm/yyyy)
function ValidDateFormat(dateString) {
	const pattern = /^(\d{2})\/(\d{2})\/(\d{4})$/;
	return pattern.test(dateString);
}