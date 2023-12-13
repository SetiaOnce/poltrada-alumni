"use strict";
//Class Definition
// SYSTEM INFO
function _loadInfoSystem() {
    $.ajax({
        url: BASE_URL+ "/front/load_info_system",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var opacity = '';
            var banner_text = '';
            if(data.banner_text != null){
                var banner_text = data.banner_text;
                var opacity = 'opacity-50';
            }
            $('#sectionBanner').html(`
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 rounded `+opacity+`" src="`+data.url_banner+`" alt="banner-public">
                        </div>
                    </div>
                </div>
            `);
            $('#sectionBannerMobile').html(`
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 rounded `+opacity+`" src="`+data.url_banner+`" alt="banner-public">
                        </div>
                    </div>
                </div>
            `);
            $('.logoHeaderTop').html('<img alt="Logo" src="'+data.url_logo_public+'" class="max-h-35px" />');
            $('.logoHeaderTopMobile').html('<img alt="Logo" src="'+data.url_logo_public+'" class="max-h-35px" />');
            $('.footerCopyright').html('<div class="text-dark order-2 order-md-1">'+data.copyright+'</div>');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            _blockUiPages(0), console.log('Load data error!');
        }
    });
};
//Class Initialization
jQuery(document).ready(function() {
    _loadInfoSystem(); 
});