//Class Definition
var table;var table2;
//Class Initialization
jQuery(document).ready(function() {
    loadSelectpicker_prodi();
    _loadPieProgramStudi();
    $("#cek_notar").mask("0000000000");
});
var _kegiatan = function() {
    $('html, body').animate({
        scrollTop: $("#sectionKegiatan").offset().top
    }, 1000); 
}
var _cekDataku = function() {
    $('html, body').animate({
        scrollTop: $("#sectionCekMyData").offset().top
    }, 1000); 
} 
// load prodi
function loadSelectpicker_prodi() {
    $.ajax({
        url: BASE_URL+ "/select/ajax_getprodi",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var output = '';
            var i;
            for (i = 0; i < data.length; i++) {
                output += '<option value="' + data[i].kode_prodi + '" font-size-lg bs-icon me-3">' + data[i].nama_jenjang + ' - '+ data[i].nama_prodi +'</option>';
            }
            $('#dt-filterJurusan').html(output).selectpicker('refresh').selectpicker('val', '');
        }, error: function (jqXHR, textStatus, errorThrown) {
            console.log('Load data is error');
        }
    });
}
/*************************
    OnChange Select Prodi or Jurusan 
*************************/
$('#dt-filterJurusan').change(function () {
    var kode_prodi = $(this).val();
    load_datatableAlumni(kode_prodi);
});
/*************************
    load DataTable Data Alumni
*************************/
function load_datatableAlumni(kode_prodi) {
    //datatables
    _blockUiPages(1);
    if (kode_prodi != null) {
        $('#textEmptyJurusan').hide();
        $('#tableDataAlumni').show();
        table = $('#dt-alumni').DataTable({
            "processing": true,
            "serverSide": true,
            "order" : [],
            // Load data for the table's content from an Ajax source
            "ajax" : {
                "url" : BASE_URL+ "/front/ajax/load_data_alumni",
                'headers': { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                "type" : "POST",
                "data"  : function ( data ) {
                    data.kode_prodi  = kode_prodi;
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
            "lengthMenu": false,
            "info": false,
            "paging": false,
            "lengthMenu": [[-1], ["Semua"]], 
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'notar', name: 'notar'},
                { data: 'nama', name: 'nama'},
                { data: 'angkatan', name: 'angkatan'},
                { data: 'jurusan', name: 'jurusan'},
                { data: 'instansi', name: 'instansi'},
            ],
            //Set column definition initialisation properties.
            "columnDefs": [
                { "width": "5%", "targets": 0, "className": "align-top text-center" },
                { "width": "5%", "targets": 1, "className": "align-top text-center" },
                { "width": "30%", "targets": 2, "className": "align-top" },
                { "width": "10%", "targets": 3, "className": "align-top text-center" },
                { "width": "30%", "targets": 4, "className": "align-top", "orderable": false },
                { "width": "20%", "targets": 5, "className": "align-top text-center", "orderable": false},
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
            }
        });
        $('#dt-alumni').css('width', '100%').DataTable().columns.adjust().draw();
        _blockUiPages(0);   
    }else{
        $('#textEmptyJurusan').show();
        $('#tableDataAlumni').hide();
    }
};
/*************************
    for handle pie chart
*************************/
const _loadPieProgramStudi = () => {
    $.ajax({
        url: BASE_URL+ "/front/ajax/load_pie_programstudi",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var data = data.output
            Highcharts.chart('pieChart', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie',
                },
                title: {
                    text: 'PROGRAM STUDI'
                },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var value = dataset.data[tooltipItem.index];
                            return value.toFixed(0); // Show only the integer value
                        }
                    }
                },
                plotOptions: {
                    pie: {
                        innerSize: 60, // Adjust innerSize to create a donut
                        depth: 45,
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>',
                            // format: '<b>{point.name}</b>: {point.percentage:f}',
                            
                        }
                    }
                },
                series: [{
                    name: 'Jumlah',
                    data: data
                }]
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Load pie chart data error!');
        }
    });
}
/*************************
    for handle Maps
*************************/
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat:-4.0033269  , lng: 116.7254844 },
        zoom: 4,
    });
    setMarkers(map);
}
const setMarkers = (map) => {
    $.ajax({
        url: BASE_URL+ "/front/ajax/load_maps_alumni",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var arrayMaps = data.arrayMaps;
            arrayMaps.forEach(function(location) {
                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(location.lat), lng: parseFloat(location.lng)},
                    map: map,
                    icon: image,
                    zIndex: location.id,
                });
                var infoWindow = new google.maps.InfoWindow({
                    content: '<div><strong>' + location.province + '</strong><br><span class="font-weight-bolder text-muted">'+ location.alumni +' Alumni</span></div>'
                });
                marker.addListener('mouseover', function() {
                    infoWindow.open(map, marker);
                });
                marker.addListener('mouseout', function() {
                    infoWindow.close();
                });
                marker.addListener('click', function() {
                    var idp = location.id;
                    _loadMoldaDataAlumni(idp, location.province, location.alumni);
                });
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Load maps data error!');
        }
    });
}
const _loadMoldaDataAlumni = (fid_provinsi, province, alumni) => {
     //datatables
     _blockUiPages(1);
     if (fid_provinsi != null) {
         table2 = $('#dt-modalAlumni').DataTable({
             "processing": true,
             "serverSide": true,
             "order" : [],
             // Load data for the table's content from an Ajax source
             "ajax" : {
                 "url" : BASE_URL+ "/front/ajax/load_modal_alumni",
                 'headers': { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
                 "type" : "POST",
                 "data"  : function ( data ) {
                     data.fid_provinsi  = fid_provinsi;
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
             "lengthMenu": false,
             "info": false,
             "paging": false,
             "lengthMenu": [[-1], ["Semua"]], 
             columns: [
                 { data: 'DT_RowIndex', name: 'DT_RowIndex'},
                 { data: 'notar', name: 'notar'},
                 { data: 'nama', name: 'nama'},
                 { data: 'angkatan', name: 'angkatan'},
                 { data: 'jurusan', name: 'jurusan'},
                 { data: 'instansi', name: 'instansi'},
             ],
             //Set column definition initialisation properties.
             "columnDefs": [
                 { "width": "5%", "targets": 0, "className": "align-top text-center" },
                 { "width": "5%", "targets": 1, "className": "align-top text-center" },
                 { "width": "30%", "targets": 2, "className": "align-top" },
                 { "width": "10%", "targets": 3, "className": "align-top text-center" },
                 { "width": "30%", "targets": 4, "className": "align-top", "orderable": false },
                 { "width": "20%", "targets": 5, "className": "align-top text-center", "orderable": false},
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
                 $('[name="dt-modalAlumni_length"]').removeClass('custom-select custom-select-sm').selectpicker(), $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'}).on('click', function(){$(this).tooltip('hide')});
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
         $('#dt-modalAlumni').css('width', '100%').DataTable().columns.adjust().draw();
         _blockUiPages(0);   
         $('#viewModalSebaranAlumni').modal('show')
         $('#viewModalSebaranAlumni .modal-title').html('<span class="mdi mdi-account-group"></span> DATA SEBARAN ALUMNI | PROVINSI '+ province +' ('+ alumni +')')
     }else{
        $('#viewModalSebaranAlumni').modal('hide')
     }
}
/*************************
    For Checking dataku
*************************/
//Check by press enter
$("#cek_notar").keyup(function (event) {
    if (event.keyCode == 13 || event.key === "Enter") {
        $("#btn-cekData").click();
    }
});
const _confirmCekDataku = () => {
    $('#btn-cekData').addClass('spinner spinner-light spinner-left').html('Mencari data...').attr('disabled', true);
    var cek_notar = $('#cek_notar');
    if (cek_notar.val() == '') {
        toastr.error('Masukan notar/nim sebagai acuan pencarian data...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
        cek_notar.focus();
        $('#btn-cekData').removeClass('spinner spinner-light spinner-left').html('<i class="icofont-search-2"></i> Cek dataku ').attr('disabled', false);
        _blockUiPages(0);
        return false;
    }
    notar = cek_notar.val();
    $('#pardonDataku').hide();
    $.ajax({
        url: BASE_URL+ "/front/ajax/cek_dataku",
        type: "GET",
        dataType: "JSON",
        data: {
            notar,
        },success: function (data) {
            $('#btn-cekData').removeClass('spinner spinner-light spinner-left').html('<i class="icofont-search-2"></i> Cek dataku ').attr('disabled', false);
            $('#pardonDataku').show();
            if(data == ''){
                $('#pardonDataku').html(`
                    <div class="alert alert-danger" role="alert">
                        <strong>Maaf!</strong> data tidak temukan cek kembali notar yang dimasukkan...
                    </div>
                `);
            }else{
                $('#pardonDataku').html(data);
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
        },
        error: function (jqXHR, textStatus, errorThrown) {
            _blockUiPages(0), console.log('Load data error!');
        }
    });
}
/*************************
    For Handle load kegiatan
*************************/
const _loadMoreKegiatan = (page) => {
    $.ajax({
        url: BASE_URL+ "/front/load_more_kegiatan?page="+page,
        success: function (data) {
            $('.more-kegiatan').html(data);
        }, error: function (jqXHR, textStatus, errorThrown) {
            console.log('Load data is error');
        }
    });
}
/*************************
    for clicking on pagination links kegiatan
*************************/
$(document).on('click', '#paginate-kegiatan a', function (e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    _loadMoreKegiatan(page);
});