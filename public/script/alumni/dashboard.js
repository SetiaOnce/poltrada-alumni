"use strict";
//Class Definition
// SYSTEM USER PROFILE
function _loadAlumniProfile() {
    $.ajax({
        url: BASE_URL+ "/app_alumni/load_dashboard_profile/",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#contentProfile').html(data);
            $('#sectionProfile').show();
            $('.image-popup').magnificPopup({
                type: 'image',  closeOnContentClick: true, closeBtnInside: false, fixedContentPos: true,
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true, duration: 150
                },
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            _blockUiPages(0), console.log('Load data error!');
        }
    });
};
// LOAD TRACER STUDY    
function _loadTracerStudy() {
    $.ajax({
        url: BASE_URL+ "/app_alumni/load_dashboard_tracer_study",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#sectionTracerStudy').html(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            _blockUiPages(0), console.log('Load data error!');
        }
    });
};
// Load Kartu Hasil Study   
function _loadKartuHasilStudy() {
    //datatables
    $('#dt-khs').DataTable({
        "processing": true,
        "serverSide": true,
        "order" : [],
        // Load data for the table's content from an Ajax source
        "ajax" : {
            "url" : BASE_URL+ "/app_alumni/load_kartu_hasil_study",
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
        "paging": false,
        "info" : false,
        columns: [
            { data: 'semester', name: 'semester'},
            { data: 'kode_matakuliah', name: 'kode_matakuliah'},
            { data: 'nama_matakuliah', name: 'nama_matakuliah'},
            { data: 'sks_matakuliah', name: 'sks_matakuliah'},
            { data: 'nilai_total', name: 'nilai_total'},
            { data: 'grade', name: 'grade'},
        ],
        //Set column definition initialisation properties.
        "columnDefs": [
            { "width": "5%", "targets": 0, "className": "align-top text-center", "visible": false},
            { "width": "10%", "targets": 1, "className": "align-top text-center",  "orderable": false},
            { "width": "30%", "targets": 2, "className": "align-top",  "orderable": false},
            { "width": "15%", "targets": 3, "className": "align-top text-center", "orderable": false},
            { "width": "15%", "targets": 4, "className": "align-top text-center", "orderable": false},
            { "width": "15%", "targets": 5, "className": "align-top text-center",  "orderable": false},
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
            $('[name="dt-alumni_length"]').removeClass('custom-select custom-select-sm').selectpicker(), $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'}).on('click', function(){$(this).tooltip('hide')});
            $('.image-popup').magnificPopup({
                type: 'image',  closeOnContentClick: true, closeBtnInside: false, fixedContentPos: true,
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true, duration: 150
                },
            });
            var api = this.api();
			var rows = api.rows({
				page: 'current'
			}).nodes();
			var last = null;
			api.column(0, {
				page: 'current'
			}).data().each(function (group, i) {
				if (last !== group) {
					$(rows).eq(i).before(
						'<tr class="align-middle"><td class="bg-secondary" colspan="6"><b>SEMESTER ' + group + '</b></td></tr>'
					);
					last = group;
				}
			});
        }
    });
    $('#dt-khs').css('width', '100%').DataTable().columns.adjust().draw();
};
//Class Initialization
jQuery(document).ready(function() {
    _loadAlumniProfile(), _loadTracerStudy(),_loadKartuHasilStudy(); 
});