// USER INFO
function loadUserInfo_pages() {
    _blockUiPages(1), $('#form-user')[0].reset(), load_filethumbnailuser(''), $('#status_user').selectpicker('val', '');
    $.ajax({
        url: base_url+ "app_admin/load_user_profile/",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            _blockUiPages(0);
            $('[name="id"]').val(data.id), load_filethumbnailuser(data.foto),
            $('#nama_user').val(data.nama),
            $('#nik_user').val(data.nik),
            $('#level').val(data.level),
            $('#alamat_user').val(data.alamat),
            $('#email_user').val(data.email),
            $('#unit_kerja').val(data.unit_kerja);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            _blockUiPages(0), console.log('Load data error!');
        }
    });
};

//Load User Thumbnail to Form
function load_filethumbnailuser(url_file){
    if (url_file == "") {
        var drEvent1 = $('#thumb_user').dropify({
            defaultFile: base_url+ 'dist/img/default-user-img.jpg',
        });
        drEvent1 = drEvent1.data('dropify');
        drEvent1.resetPreview();
        drEvent1.clearElement();
        drEvent1.settings.defaultFile = base_url+ 'dist/img/default-user-img.jpg';
        drEvent1.destroy();
        drEvent1.init();
    } else {
        var drEvent1 = $('#thumb_user').dropify({
            defaultFile: url_file,
        });
        drEvent1 = drEvent1.data('dropify');
        drEvent1.resetPreview();
        drEvent1.clearElement();
        drEvent1.settings.defaultFile = url_file;
        drEvent1.destroy();
        drEvent1.init();
    }
}

// Class Initialization
jQuery(document).ready(function() {
    loadUserInfo_pages();
});