"use strict";
//Class Definition
var save_method; var table1;var table2;
//Class Initialization
jQuery(document).ready(function() {
    _loadReportTracerStudy();
});
//Close Content Card by Open Method
const _closeCard = () => {
    $('#card-detail .card-header .card-title').html('');
    $('#card-detail').hide(), $('#card-data').show();
}
//Load Datatables
const _loadReportTracerStudy = () => {
    //datatables
    table1 = $('#dt-reportTracer').DataTable({
        "processing": true,
        "serverSide": true,
        "order" : [],
        // Load data for the table's content from an Ajax source
        "ajax" : {
            "url" : BASE_URL+ "/ajax/load_report_tracer_study",
            'headers': { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            "type" : "POST",
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
            { data: 'judul', name: 'judul'},
            { data: 'date_awal', name: 'date_awal'},
            { data: 'date_akhir', name: 'date_akhir'},
            { data: 'jumlah_responden', name: 'jumlah_responden'},
            { data: 'action', name: 'action'},
        ],
        //Set column definition initialisation properties.
        "columnDefs": [
            { "width": "5%", "targets": 0, "className": "align-top text-center" },
            { "width": "40%", "targets": 1, "className": "align-top" },
            { "width": "15%", "targets": 2, "className": "align-top text-center" },
            { "width": "15%", "targets": 3, "className": "align-top text-center" },
            { "width": "15%", "targets": 4, "className": "align-top text-center" },
            { "width": "15%", "targets": 5, "className": "align-top text-center", "orderable": false, "searchable": false},
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
            $('[name="dt-reportTracer_length"]').removeClass('custom-select custom-select-sm').selectpicker(), $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'}).on('click', function(){$(this).tooltip('hide')});
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
    $('#dt-reportTracer').css('width', '100%').DataTable().columns.adjust().draw();
}
// load detail peserta
const _showPesertaTracer= (idp_jadwal) => {
    _blockUiPages(1);
    $.ajax({
        url: BASE_URL+ "/ajax/load_detail_info_tracer_study",
        type: "GET",
        dataType: "JSON",
        data:{
            idp_jadwal
        },success: function (data) {
            _blockUiPages(0), $('#card-detail .card-header .card-title').html(`<h3 class="card-label"><i class="bi bi-people text-dark"></i> Peserta Tracer Study</h3>`);

            $('#sectionDetailJadwal').html(data.output);            
            _loadDataPesertaTracer(idp_jadwal);
            $('#card-data').hide(), $('#card-detail').show();   
            $('html, body').animate({
                scrollTop: $("#card-detail").offset().top
            }, 1000);          
        },
        error: function (jqXHR, textStatus, errorThrown) {
            _blockUiPages(0), console.log('Load data error!');
        }
    });
}
// datatable peserta tracer
const _loadDataPesertaTracer= (idp_jadwal) => {
    //datatables
    table2 = $('#dt-pesertaTracer').DataTable({
        "processing": true,
        "serverSide": true,
        "order" : [],
        // Load data for the table's content from an Ajax source
        "ajax" : {
            "url" : BASE_URL+ "/ajax/load_peserta_report_tracer_study",
            'headers': { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            "type" : "POST",
            "data"  : function ( data ) {
                data.idp_jadwal  = idp_jadwal;
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
            { data: 'nama_lengkap', name: 'nama_lengkap'},
            { data: 'nim', name: 'nim'},
            { data: 'jenis_kelamin', name: 'jenis_kelamin'},
            { data: 'prodi', name: 'prodi'},
            { data: 'tahun_lulus', name: 'tahun_lulus'},
        ],
        //Set column definition initialisation properties.
        "columnDefs": [
            { "width": "5%", "targets": 0, "className": "align-top text-center" },
            { "width": "20%", "targets": 1, "className": "align-top" },
            { "width": "20%", "targets": 2, "className": "align-top text-center", "orderable": false, "searchable": false},
            { "width": "20%", "targets": 3, "className": "align-top text-center" },
            { "width": "20%", "targets": 4, "className": "align-top", "orderable": false, "searchable": false},
            { "width": "15%", "targets": 5, "className": "align-top text-center"},
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
            $('[name="dt-pesertaTracer_length"]').removeClass('custom-select custom-select-sm').selectpicker(), $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'}).on('click', function(){$(this).tooltip('hide')});
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
    $('#dt-pesertaTracer').css('width', '100%').DataTable().columns.adjust().draw();
}