"use strict";
//Class Definition
var save_method; var table;
//Class Initialization
jQuery(document).ready(function() {
    _loadDataKegiatan();
    //Reset Filter
    $('#btn-resetDt').click(function(e){
        e.preventDefault();
        $('#filterDt').selectpicker('val', '5'), load_dtgaleri();
    });
});
//Load Datatables banner
const _loadDataKegiatan = () => {
   //datatables
   table = $('#dt-kegiatan').DataTable({
        "processing": true,
        "serverSide": true,
        "order" : [],
        // Load data for the table's content from an Ajax source
        "ajax" : {
            "url" : BASE_URL+ "/ajax/load_kegiatan",
            'headers': { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            "type" : "POST",
            "data"  : function ( data ) {
                data.filter  = $('#filterDt').val();
            }
        },
        "destroy" : true,
        "draw" : true,
        "deferRender" : true,
        "responsive" : false,
        "autoWidth" : true,
        "LengthChange" : true,
        "paginate" : true,
        "pageResize" : true,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'data', name: 'data'},
            { data: 'keyword_tag', name: 'keyword_tag'},
            { data: 'views', name: 'views'},
            { data: 'thumnail', name: 'thumnail'},
            { data: 'status', name: 'status'},
            { data: 'action', name: 'action'},
        ],
        //Set column definition initialisation properties.
        "columnDefs": [
            { "width": "1%", "targets": 0, "className": "align-top text-center" },
            { "width": "41%", "targets": 1, "className": "align-top" },
            { "width": "30%", "targets": 2, "className": "align-top" },
            { "width": "1%", "targets": 3, "className": "align-top text-center" },
            { "width": "1%", "targets": 4, "className": "align-top text-center", "orderable": false },
            { "width": "1%", "targets": 5, "className": "align-top text-center" },
            { "width": "15%", "targets": 6, "className": "align-top text-center", "orderable": false }
        ],
        "oLanguage": {
            "sSearch" : "<i class='flaticon-search-1'></i>",
            "sSearchPlaceholder": "Pencarian...",
            "sEmptyTable" : "Tidak ada Data yang dapat ditampilkan..",
            "sInfo" : "Menampilkan _START_ s/d _END_ dari _TOTAL_ entri.",
            "sInfoEmpty" : "Menampilkan 0 - 0 dari 0 entri.",
            "sInfoFiltered" : "",
            "sProcessing" : `<div class="d-flex justify-content-center align-items-center"><span class="spinner spinner-track position-static spinner-primary spinner-lg spinner-left"></span> <span class="text-dark">Mohon tunggu...</span></div>`,
            "sZeroRecords": "Tidak ada Data yang dapat ditampilkan..",
            "sLengthMenu" : "Tampilkan _MENU_",
            "oPaginate" : {
                "sPrevious" : "Sebelumnya",
                "sNext" : "Selanjutnya"
            }
        },
        "fnDrawCallback": function () {
            $('[name="dt-kegiatan_length"]').removeClass('custom-select custom-select-sm').selectpicker(), $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'}).on('click', function(){$(this).tooltip('hide')});
            $('.image-popup').magnificPopup({
                type: 'image',  closeOnContentClick: true, closeBtnInside: false, fixedContentPos: true,
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true, duration: 150
                },
            });
        }
    });
    $('#dt-kegiatan').css('width', '100%').DataTable().columns.adjust().draw();
}
//Load Change Filter Data
$('#filterDt').on('changed.bs.select', function(e){
    _loadDataKegiatan();
});
//Keyword Galeri
$('#keyword_tag_kegiatan').select2({
    dropdownAutoWidth: true,
    tags: true,
    maximumSelectionLength: 25,
    placeholder: 'Isi kata kunci/ keyword konten kegiatan ...',
    tokenSeparators: [','],
    width: '100%',
    language: { noResults: () => 'Gunakan tanda koma (,) sebagai pemisah tag'}
});
//Summernote
$('#isi_kegiatan').summernote({
    placeholder: 'Isi konten kegiatan ...',
    height: 650, minHeight: null, maxHeight: null, dialogsInBody: false, focus: false,
    callbacks: {
        onImageUpload: function(image) {
            _uploadFile_editor(image[0], '');
            _blockUiPages(0);
        }
    }
});
//Load Datepicker Input
$('#tgl_post_kegiatan').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: "dd/mm/yyyy",
    language: "id"
});
$('#tgl_post_kegiatan').mask('00/00/0000');
//Load Dropify
function _loadDropifyFile(url_file, paramDiv) {
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
$('.dropify-fr').dropify({
    messages: {
        'default': '<span class="btn btn-sm btn-secondary">Drag/ drop file atau Klik disini</span>',
        'replace': '<span class="btn btn-sm btn-primary"><i class="fas fa-upload"></i> Drag/ drop atau Klik untuk menimpa file</span>',
        'remove':  '<span class="btn btn-sm btn-danger"><i class="las la-trash-alt"></i> Reset</span>',
        'error':   'Ooops, Terjadi kesalahan pada file input'
    }, error: {
        'fileSize': 'Ukuran file terlalu besar, Max. ( {{ value }} )',
        'minWidth': 'Lebar gambar terlalu kecil, Min. ( {{ value }}}px )',
        'maxWidth': 'Lebar gambar terlalu besar, Max. ( {{ value }}}px )',
        'minHeight': 'Tinggi gambar terlalu kecil, Min. ( {{ value }}}px )',
        'maxHeight': 'Tinggi gambar terlalu besar, Max. ( {{ value }}px )',
        'imageFormat': 'Format file tidak diizinkan, Hanya ( {{ value }} )'
    }
});
//Close Content Card by Open Method
const _closeCard = (card) => {
    if(card=='form_kegiatan') {
        save_method = '';
        _clearForm(), $('#card-form .card-header .card-title').html('');
    }
    $('#card-form').hide(), $('#card-data').show();
}
//Clear Form Kegiatan
const _clearForm = () => {
    if (save_method == "" || save_method == "add_data") {
        var today = new Date();
        var dateNow = today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
        $("#form-data")[0].reset();
        $('[name="id"]').val(""), $('#iGroup-Status').hide();
        $('#isi_kegiatan').summernote('code', ''), $('#keyword_tag_kegiatan').val(null).trigger('change'), $('#tgl_post_kegiatan').datepicker('update', dateNow), $('#status').selectpicker('val', '');
        $('#permalink_text').html('').removeClass('d-block').hide(), $('#permalink_galeri').val('');
    } else {
        let id = $('[name="id"]').val();
        _editKegiatan(id);
    }
}
//Add Kegiatan
const _addData = () => {
    save_method = "add_data";
    _clearForm(),
    _loadDropifyFile('', '#thumbnail'),
    $("#card-form .card-header .card-title").html(
        `<h3 class="fw-bolder fs-2 text-gray-900"><i class="flaticon2-plus text-dark mr-2"></i>Form Tambah Kegiatan</h3>`
    ),
    $("#card-data").hide(), $("#card-form").show(), $('#col-formSrc').hide(), $('.hideFormSrc').hide();
}
//Edit Kegiatan
const _editKegiatan = (idp) => {
    save_method = "update_data";
    _blockUiPages(1);
    $('#iGroup-Status').show(), $('[name="methodform_asesor"]').val('update');
    //Ajax load from ajax
    $.ajax({
        url: BASE_URL+ '/ajax/kegiatan_edit',
        headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
        type: 'GET',
        dataType: 'JSON',
        data: {
            idp,
        },
        success: function (data) {
            _blockUiPages(0);
            if (data.status == true) {
                $('[name="id"]').val(data.row.id);
                $('#judul_kegiatan').val(data.row.judul);
                // url
                var get_slug = BASE_URL +'/baca/'+data.row.id+'/'+data.row.slug;
                if(data.row.status==1){
                    $('#permalink_text').html(`Permalink: <a href="` +get_slug+ `" class="text-dark-65" data-toggle="tooltip" title="Lihat postingan kegiatan pada halaman publik!" target="_blank">`+ get_slug +`</a>`).addClass('d-block').show();
                }else{
                    $('#permalink_text').html(`Permalink: <a href="javascript:void(0);" class="text-dark-65" data-toggle="tooltip" title="Preview isi konten galeri kegiatan!" onclick="preview_galeri('');">`+ get_slug +`</a>`).addClass('d-block').show();
                }
                $('#permalink_galeri').val(data.row.slug);
                 //Summernote Isi Galeri Kegiatan
                 var isiKonten = data.row.isi;
                 $('#isi_kegiatan').summernote('code', isiKonten);
                // Keyword
                var selected = '';
                var i;
                for (i = 0; i < data.tagarray.length; i++) {
                    selected += '<option value="' + data.tagarray[i] + '" selected>' + data.tagarray[i] + '</option>';
                }
                _loadDropifyFile(data.url_thumbnail, '#thumbnail');
                $("#keyword_tag_kegiatan").html(selected).trigger('change');
                $('#tgl_post_kegiatan').datepicker('update', data.tgl_post);
                //Status
                $('#status').selectpicker('val', data.row.status);
                $("#card-form .card-header .card-title").html(
                    `<h3 class="fw-bolder fs-2 text-gray-900"><i class="bi bi-pencil-square fs-2 mr-2 align-center"></i>Form Edit Konten Kegiatan</h3>`
                ),
                $('#btnShowFoto').show(), $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'}).on('click', function(){$(this).tooltip('hide')});
                $("#card-data").hide(), $("#card-form").show(), $('#col-formSrc').hide(), $('.hideFormSrc').hide();
            } else {
                Swal.fire({title: "Ooops!", text: data.message, icon: "warning", allowOutsideClick: false});
            }
        }, error: function (jqXHR, textStatus, errorThrown) {
            _blockUiPages(0);
            console.log("load data is error!");
            Swal.fire({
                title: "Ooops!",
                text: "Terjadi kesalahan yang tidak diketahui, Periksa koneksi jaringan internet lalu coba kembali. Mohon hubungi pengembang jika masih mengalami masalah yang sama.",
                icon: "error",
                allowOutsideClick: false,
            });
        },
    });
}
//Save Kegiatan by Enter
$("#form-data input").keyup(function (event) {
    if (event.keyCode == 13 || event.key === "Enter") {
        $("#btn-save").click();
    }
});
//Save Kegiatan Form
$("#btn-save").on("click", function (e) {
    e.preventDefault();
    $('#btn-save').addClass('spinner spinner-light spinner-right').html('Menyimpan data...').attr('disabled', true);

    var judul_kegiatan = $('#judul_kegiatan');
    var isi_kegiatan = $('#isi_kegiatan');
    var keyword_tag_kegiatan = $('#keyword_tag_kegiatan');
    var tgl_post_kegiatan = $('#tgl_post_kegiatan');
    var thumbnail = $('#thumbnail');
    var thumbnail_priview = $('#fg-Thumnail .dropify-preview .dropify-render').html();

    if (judul_kegiatan.val() == '') {
        toastr.error('Judul konten kegiatan masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        judul_kegiatan.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (isi_kegiatan.summernote('isEmpty')) {
        toastr.error('Isi konten kegiatan masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        isi_kegiatan.summernote('focus');
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (keyword_tag_kegiatan.val() == '' || keyword_tag_kegiatan.val() == null) {
        toastr.error('Kata kunci/ Tag konten kegiatan masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        keyword_tag_kegiatan.focus().select2('open');
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (tgl_post_kegiatan.val() == '') {
        toastr.error('Tgl. post konten kegiatan masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        tgl_post_kegiatan.focus();
        $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if(save_method == 'add_data'){
        if (thumbnail_priview == '') {
            toastr.error('Thumbnail konten kegiatan masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
            $('#fg-Thumnail .dropify-wrapper').addClass('file-input-error').stop().delay(2500).queue(function () {
                $(this).removeClass('file-input-error');
            });
            thumbnail.focus();
            $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
            _blockUiPages(0);
            return false;
        }
    }
    let textConfirmSave = "Simpan perubahan data sekarang ?";
    if (save_method == "add_data") {
        textConfirmSave = "Tambahkan data sekarang ?";
    }

    Swal.fire({
        title: "",
        text: textConfirmSave,
        icon: "question",
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.value) {
            _blockUiPages(1);
            let formData = new FormData($("#form-data")[0]), ajax_url = BASE_URL+ "/ajax/kegiatan_save";
            if(save_method == 'update_data') {
                ajax_url = BASE_URL+ "/ajax/kegiatan_update";
            }
            $.ajax({
                url: ajax_url,
                headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (data) {
                    $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
                    _blockUiPages(0);
                    
                    if (data.status == true) {
                        var message = 'Konten kegiatan berhasil perbarui'
                        if(save_method == 'add_data'){
                            var message = 'Konten kegiatan baru berhasil ditambahkan'
                        }
                        Swal.fire({
                            title: "Success!",
                            text: message,
                            icon: "success",
                            allowOutsideClick: false,
                        }).then(function (result) {
                            _closeCard('form_kegiatan'), _loadDataKegiatan();
                        });
                    } else {
                        if(data.pesan_code=='format_inputan') {   
                            Swal.fire({
                                title: "Ooops!",
                                html: data.pesan_error[0],
                                icon: "warning",
                                allowOutsideClick: false,
                            });
                        } else {
                            Swal.fire({
                                title: "Ooops!",
                                html: data.pesan_error,
                                icon: "warning",
                                allowOutsideClick: false,
                            });
                        }
                    }
                }, error: function (jqXHR, textStatus, errorThrown) {
                    $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
                    _blockUiPages(0);
                    Swal.fire({
                        title: "Ooops!",
                        text: "Terjadi kesalahan yang tidak diketahui, Periksa koneksi jaringan internet lalu coba kembali. Mohon hubungi pengembang jika masih mengalami masalah yang sama.",
                        icon: "error",
                        allowOutsideClick: false,
                    });
                }
            });
        } else {
            $('#btn-save').removeClass('spinner spinner-light spinner-right').html('<i class="far fa-save"></i> Simpan').attr('disabled', false);
        }
    });
});
//Update Status Data Kegiatan
const _updateStatus = (idp, value) => {
    let textLbl = 'Nonaktifkan';
    if(value=='1') {
        textLbl = 'Aktifkan';
    }
    let textSwal = textLbl+ ' kegiatan sekarang ?';
    if(value=='100') {
        textSwal = 'Yakin ingin memindahkan postingan ini ke data sampah ?';
    }
    Swal.fire({
        title: "",
        html: textSwal,
        icon: "question",
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak, Batalkan!"
    }).then(result => {
        if (result.value) {
            _blockUiPages(1);
            // Load Ajax
            $.ajax({
                url: BASE_URL+ "/ajax/kegiatan_update_status",
                headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                dataType: "JSON",
                data: {
                    idp, value
                }, success: function (data) {
                    _blockUiPages(0);
                    Swal.fire({ title: "Success!", html: data.message, icon: "success", allowOutsideClick: false }).then(function (result) {
                        _loadDataKegiatan();
                    });
                }, error: function (jqXHR, textStatus, errorThrown) {
                    _blockUiPages(0);
                    Swal.fire({ title: "Ooops!", text: "Terjadi kesalahan yang tidak diketahui, Periksa koneksi jaringan internet lalu coba kembali. Mohon hubungi pengembang jika masih mengalami masalah yang sama.", icon: "error", allowOutsideClick: false }).then(function (result) {
                        console.log("Update data is error!");
                        _loadDataKegiatan();
                    });
                }
            });
        }
    });
}
//Delete Data kegiatan galeri
const _deleteKegiatanGaleri = (idp) => {
    Swal.fire({
        title: "",
        html: "Hapus kegiatan sekarang?",
        icon: "question",
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak, Batalkan!"
    }).then(result => {
        if (result.value) {
            _blockUiPages(1);
            // Load Ajax
            $.ajax({
                url: BASE_URL+ "/ajax/kegiatan_destroy",
                headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                dataType: "JSON",
                data: {
                    idp
                }, success: function (data) {
                    _blockUiPages(0);
                    Swal.fire({ title: "Success!", html: "Data berhasil dihapus", icon: "success", allowOutsideClick: false }).then(function (result) {
                        _loadDataKegiatan();
                    });
                }, error: function (jqXHR, textStatus, errorThrown) {
                    _blockUiPages(0);
                    Swal.fire({ title: "Ooops!", text: "Terjadi kesalahan yang tidak diketahui, Periksa koneksi jaringan internet lalu coba kembali. Mohon hubungi pengembang jika masih mengalami masalah yang sama.", icon: "error", allowOutsideClick: false }).then(function (result) {
                        console.log("Update data is error!");
                        _loadDataKegiatan();
                    });
                }
            });
        }
    });
}

// ====>> KELOLA GAMBAR GALERI <<==== //
//Load list foto galeri kegiatan
function load_listfotogalerikegiatan(idp_kegiatan) {
    _blockUiPages(1);
    $.ajax({
        url : BASE_URL+ "/ajax/ajax_get_kegiatan_album",
        headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
        type: "POST",
        dataType: "JSON",
        data: {
            'idp_kegiatan': idp_kegiatan
        }, success: function(data){
            if(data.galerikegiatan==''){
                $('#list-srcGaleri').html('<div class="col-lg-12 text-center">File foto galeri kegiatan tidak ditemukan... <br/>Klik tombol <strong>"Tambah Foto"</strong> untuk menambahkan galeri kegiatan.</div>');
            }else{
                $('#list-srcGaleri').html(data.galerikegiatan);
                $('#list-srcGaleri').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    tLoading: 'Sedang memuat foto #%curr%...',
                    mainClass: 'mfp-img-mobile',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: false,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    },
                    image: {
                        tError: '<a href="%url%">Foto #%curr%</a> tidak dapat dimuat...',
                        titleSrc: function(item) {
                            return item.el.attr('title') + '<small>'+item.el.attr('subtitle')+'</small>';
                        }
                    }
                });
            }
            _blockUiPages(0);
        }, error: function (jqXHR, textStatus, errorThrown){
            _blockUiPages(0);
            Swal.fire({title: "Ooops!", text: "Terjadi kesalahan yang tidak diketahui, mohon hubungi pengembang...", icon: "error"}).then(function(result){
                console.log("Update data is error!");
            });
        }
    });
}
//Close Form Foto Galeri
function closeFormSrc(selector){
    $('#col-formSrc .card-header .card-title').html(''), $('#btnAddSrc').show(),
    $('#col-formSrc').hide(), $('.hideFormSrc').hide(), $('#' +selector).show();
}
//Add Form Foto Galeri
function addFormSrc(){
    $('#btnAddSrc').hide(), $('#caption_filekegiatan').val(''), $('.hideFormSrc').show(), _loadDropifyFile('', '#file_name');
}
//Close Add Form Foto Galeri
function closeAddFormSrc(){
    $('#btnAddSrc').show(), $('#caption_filekegiatan').val(''), $('.hideFormSrc').hide(), _loadDropifyFile('', '#file_name');
}
//Save Show Foto Galeri by Button
$('#btnShowFoto').click(function (e) {
    e.preventDefault();
    var idp_kegiatan = $('[name="id"]').val();
    $('#btnCloseSrc').attr("onclick","closeFormSrc('card-form')");
    $('[name="fid_kegiatan"]').val(idp_kegiatan), load_listfotogalerikegiatan(idp_kegiatan);
    $('#col-formSrc .card-header .card-title').html('<h3 class="card-label"><i class="mdi mdi-folder-multiple-image text-dark"></i> Foto-Foto Kegiatan</h3>');
    $('#card-data').hide(), $('#card-form').hide(), $('#col-formSrc').show(), $('.hideFormSrc').hide();
});
//Save Show Foto Galeri by Function
function kelola_galeri(idp){
    var idp_kegiatan = idp;
    $('#btnCloseSrc').attr("onclick","closeFormSrc('card-data')");
    $('[name="fid_kegiatan"]').val(idp_kegiatan), load_listfotogalerikegiatan(idp_kegiatan);
    $('#col-formSrc .card-header .card-title').html('<h3 class="card-label"><i class="mdi mdi-folder-multiple-image text-dark"></i> Foto-Foto Kegiatan</h3>');
    $('#card-data').hide(), $('#card-form').hide(), $('#col-formSrc').show(), $('.hideFormSrc').hide();
}
// save galeri kegiatan image
$('#btn-saveSrc').click(function (e) {
    e.preventDefault();
    $('#btn-saveSrc').addClass('spinner spinner-light spinner-right').html('Mengupload file...').attr('disabled', true);
    _blockUiPages(1);

    var idp = $('[name="fid_kegiatan"]').val();
    var captio_filegaleri = $('#caption_filekegiatan');
    var file_name = $('#file_name');
    var filePriview = $('#fg-filename .dropify-preview .dropify-render').html();

    if (captio_filegaleri.val() == '') {
        toastr.error('Caption file foto kegiatan masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        captio_filegaleri.focus();
        $('#btn-saveSrc').removeClass('spinner spinner-light spinner-right').html('<i class="mdi mdi-upload"></i> Upload').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    if (filePriview == '') {
        toastr.error('Gambar galeri kegiatan masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        $('#fg-filename .dropify-wrapper').addClass('file-input-error').stop().delay(2500).queue(function () {
            $(this).removeClass('file-input-error');
        });
        file_name.focus();
        $('#btn-saveSrc').removeClass('spinner spinner-light spinner-right').html('<i class="mdi mdi-upload"></i> Upload').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }

    var url = BASE_URL+ "/ajax/kegiatan_album_save";
    var formData = new FormData($('#form-srcKegiatan')[0]);
    $.ajax({
        url: url,
        headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            $('#btn-saveSrc').removeClass('spinner spinner-light spinner-right').html('<i class="mdi mdi-upload"></i> Upload').attr('disabled', false);
            _blockUiPages(0);
            if (data.status == true) {
                Swal.fire({
                    title: "Success!",
                    text: 'Foto/gambar galeri kegiatan berhasil di tambahkan',
                    icon: "success",
                    allowOutsideClick: false,
                }).then(function (result) {
                    //Load Data List foto Galeri Kegiatan
                    $('#form-srcKegiatan')[0].reset(), load_listfotogalerikegiatan(idp), _loadDataKegiatan(), $('[name="fid_kegiatan"]').val(idp), _loadDropifyFile('', '#file_name');
                });
            } else {
                if(data.pesan_code=='format_inputan') {   
                    Swal.fire({
                        title: "Ooops!",
                        html: data.pesan_error[0],
                        icon: "warning",
                        allowOutsideClick: false,
                    });
                } else {
                    Swal.fire({
                        title: "Ooops!",
                        html: data.pesan_error,
                        icon: "warning",
                        allowOutsideClick: false,
                    });
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#btn-saveSrc').removeClass('spinner spinner-light spinner-right').html('<i class="mdi mdi-upload"></i> Upload').attr('disabled', false);
            _blockUiPages(0);
            Swal.fire({title: "Ooops!", text: "Terjadi kesalahan yang tidak diketahui, mohon hubungi pengembang.", icon: "error"
            }).then(function (result) {
                console.log('Load data form is error!');
            });
        }
    });
});
// delete galeri kegiatan image
function remove_galerikegiatan_src(idp, idp_kegiatan){
    Swal.fire({
        title: "",
        html: "Hapus Gambar?",
        icon: "question",
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak, Batalkan!"
    }).then(result => {
        if (result.value) {
            _blockUiPages(1);
            // Load Ajax
            $.ajax({
                url: BASE_URL+ "/ajax/kegiatan_album_destroy",
                headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                dataType: "JSON",
                data: {
                    idp
                }, success: function (data) {
                    _blockUiPages(0);
                    Swal.fire({ title: "Success!", html: "Gambar berhasil dihapus", icon: "success", allowOutsideClick: false }).then(function (result) {
                        load_listfotogalerikegiatan(idp_kegiatan);
                    });
                }, error: function (jqXHR, textStatus, errorThrown) {
                    _blockUiPages(0);
                    Swal.fire({ title: "Ooops!", text: "Terjadi kesalahan yang tidak diketahui, Periksa koneksi jaringan internet lalu coba kembali. Mohon hubungi pengembang jika masih mengalami masalah yang sama.", icon: "error", allowOutsideClick: false }).then(function (result) {
                        console.log("Update data is error!");
                        load_listfotogalerikegiatan(idp_kegiatan);
                    });
                }
            });
        }
    });
}