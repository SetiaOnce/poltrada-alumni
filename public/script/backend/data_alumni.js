"use strict";
//Class Definition
var save_method; var table;
//Class Initialization
jQuery(document).ready(function() {
    _loadDataAlumni(),loadSelectpicker_prodi();
    // date filter
    $('.yearpicker').datepicker({
        autoclose: true,
        format: "yyyy",
        weekStart: 1,
        orientation: "bottom",
        language: "id",
        keyboardNavigation: false,
        viewMode: "years",
        minViewMode: "years"
    });
    //Reset Filter
    $('#btn-resetDt').click(function(e){
        e.preventDefault();
        $('#filter-tahun').datepicker('update', '');
        $('#filter-provinsi').selectpicker('val', '');
        _loadDataAlumni();
    });
    // filter data alumni by tahun change
    $('#filter-tahun').change(function(e){
        e.preventDefault();
        _loadDataAlumni();
    });
    // filter data alumni by prodi change
    $('#filter-prodi').change(function(e){
        e.preventDefault();
        _loadDataAlumni();
    });
});
//Load Datatables banner
const _loadDataAlumni = () => {
    //datatables
    table = $('#dt-alumni').DataTable({
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            }
        ],
        "processing": true,
        "serverSide": true,
        "order" : [],
        // Load data for the table's content from an Ajax source
        "ajax" : {
            "url" : BASE_URL+ "/ajax/load_data_alumni",
            'headers': { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            "type" : "POST",
            "data"  : function ( data ) {
                data.tahun  = $('#filter-tahun').val();
                data.prodi  = $('#filter-prodi').val();
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
            { data: 'nama', name: 'nama'},
            { data: 'telp', name: 'telp'},
            { data: 'prodi', name: 'prodi'},
            { data: 'nim', name: 'nim'},
            { data: 'provinsi', name: 'provinsi'},
            { data: 'angkatan', name: 'angkatan'},
            { data: 'tanggal_lahir', name: 'tanggal_lahir'},
            { data: 'alamat', name: 'alamat'},
            { data: 'instansi', name: 'instansi'},
            { data: 'foto', name: 'foto'},
        ],
        //Set column definition initialisation properties.
        "columnDefs": [
            { "width": "5%", "targets": 0, "className": "align-top text-center" },
            { "width": "10%", "targets": 1, "className": "align-top" },
            { "width": "10%", "targets": 2, "className": "align-top" },
            { "width": "10%", "targets": 3, "className": "align-top text-center" },
            { "width": "10%", "targets": 4, "className": "align-top", "orderable": false},
            { "width": "10%", "targets": 5, "className": "align-top text-center"},
            { "width": "10%", "targets": 6, "className": "align-top text-center"},
            { "width": "10%", "targets": 7, "className": "align-top text-center"},
            { "width": "15%", "targets": 8, "className": "align-top"},
            { "width": "10%", "targets": 9, "className": "align-top"},
            { "width": "10%", "targets": 10, "className": "align-top text-center", "orderable": false, "searchable": false},
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
    $('#export_excel').on('click', function(e) {
        e.preventDefault();
        table.button(1).trigger();
    });
}
/*************************
    SelectPicker Select Prodi or Jurusan 
*************************/
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
            $('#filter-prodi').html(output).selectpicker('refresh').selectpicker('val', '');
        }, error: function (jqXHR, textStatus, errorThrown) {
            console.log('Load data is error');
        }
    });
}
const _sincronisasi = () => {
    Swal.fire({
        title: 'Sinkronisasi Data Alumni',
        html: `<form class="form" id="form-sincronisasiDataAlumni">
            <div class="form-group row m-0">
                <label class="col-form-label col-lg-12" for="filterLogMdl-startDate">Pilih tahun angkatan : </label>
                <div class="col-lg-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="flaticon-calendar-1"></i></span>
                        </div>
                        <input type="text" id="tahunAngkatan" name="tahunAngkatan" class="form-control" placeholder="Isi tahun angkatan..." autocomplete="off">
                    </div>
                </div>
            </div>
        </form>`,
        confirmButtonText: '<i class="bi bi-send text-light"></i> Sinkronisasi',
        focusConfirm: true,
        showCancelButton: true,
        cancelButtonText: 'Batal',
        onOpen: function() {
            //Datepicker Year Autoclose
            $("#tahunAngkatan").mask("0000");
            $('#tahunAngkatan').datepicker({
                autoclose: true,
                format: "yyyy",
                weekStart: 1,
                orientation: "bottom",
                language: "id",
                keyboardNavigation: false,
                viewMode: "years",
                minViewMode: "years"
            });
        },
        preConfirm: () => {
            const tahunAngkatan = Swal.getPopup().querySelector('#tahunAngkatan').value
            if (!tahunAngkatan) {
                Swal.showValidationMessage(`Tahun angkatan masih kosong!`)
            } return {
                tahunAngkatan: tahunAngkatan
            }
        }
    }).then((result) => {
        var tahunAngkatan = `${result.value.tahunAngkatan}`;
        _blockUiPages(1);
        // Load Ajax
        $.ajax({
            url : BASE_URL+ "/ajax/data_alumni_sincronisasi",
            headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            type: "POST",
            dataType: "JSON",
            data: {
                'tahunAngkatan': tahunAngkatan
            },
            success: function(data){
                _blockUiPages(0);
                if(data.status==true){
                    Swal.fire({title: "Success!", text: "Sinkronisasi data alumni angkatan " +tahunAngkatan+  " berhasil dilakukan...", icon: "success"}).then(function(result){
                        _loadDataAlumni();
                    });
                }else{
                    Swal.fire("Ooops!", "Gagal melakukan proses data, mohon cek kembali isian pada form yang tersedia.", "error");
                }
            }, error: function (jqXHR, textStatus, errorThrown){
                _blockUiPages(0);
                Swal.fire({title: "Ooops!", text: "Terjadi kesalahan yang tidak diketahui, mohon hubungi pengembang...", icon: "error"}).then(function(result){
                    console.log("Clean data is error!");
                    _loadDataAlumni();
                });
            }
        });
    })
}