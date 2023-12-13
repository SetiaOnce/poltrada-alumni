"use strict";
//Class Definition
// SYSTEM USER INIT
function _loadUserInit() {
    $.ajax({
        url: base_url+ "app_admin/load_profile/",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
           $('#kt_quick_user_toggle').html(data.outputNav);
           $('#userInfoSideRight').html(data.sideOutput);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            _blockUiPages(0), console.log('Load data error!');
        }
    });
};
// SYSTEM APP INIT
function _loadProfileAppInit() {
    $.ajax({
        url: base_url+ "app_admin/load_app_profile_site/",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('.logoHeaderTop').html('<img alt="Logo" src="'+data.url_logobackendhead+'" class="max-h-35px" />');
            $('.footerCopyright').html('<div class="text-dark order-2 order-md-1">'+data.copyright+'</div>');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            _blockUiPages(0), console.log('Load data error!');
        }
    });
};
//Class Initialization
jQuery(document).ready(function() {
    _loadUserInit(); 
    _loadProfileAppInit();
});
// this bellow for progres sweet alert
function systemUnderProggres(){
    Swal.fire({
        title: "Maaf!",
        text: "Fitur ini Sedang Dalam Proses Pengembangan...",
        icon: "warning",
        allowOutsideClick: false,
    });
}