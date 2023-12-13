// for popup image album
$('#elementImageKegiatan').magnificPopup({
    delegate: '.image-popup',
    type: 'image', // Set the type to 'image' if your slider contains images
    gallery: {
        enabled: true
    }
});
// Class Definition
const loadApp = function() {
    //load other kegiatan
	const _sideotherkegiatan = () => {
        let url = window.location.href,
        idp_kegiatan = url.split('/')[4],
        i,
        widgetContent = '';
        for (i = 0; i < 4; i++) {
            widgetContent += `<div class="col-lg-12 mb-6">
            <div class="d-flex align-items-center">
                <!--begin::Symbol-->
                <a href="javascript:void(0);" class="symbol symbol-70 flex-shrink-0 mr-5">
                    <img src="`+imageLoader+`" alt="">
                </a>
                <!--end::Symbol-->
                <!--begin::Text-->
                <div class="d-flex flex-column flex-grow-1">
                    <h5 class="placeholder-glow mb-0">
                        <span class="placeholder col-12 rounded"></span>
                    </h5>
                    <small class="title placeholder-glow">
                        <span class="placeholder col-6 rounded"></span>
                    </small>
                    <h5 class="placeholder-glow mb-0">
                        <span class="placeholder col-12 rounded"></span>
                    </h5>
                    <small class="title placeholder-glow">
                        <span class="placeholder col-6 rounded"></span>
                    </small>
                </div>
                <!--end::Text-->
            </div>
        </div>`;
        }
        $('#otherKegiatan').append(widgetContent);
        $.ajax({
            url: BASE_URL+ "/front/load_other_kegiatan",
            headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            type: 'GET',
            dataType: 'JSON',
            data: {
                idp_kegiatan
            },
            success: function (data) {
                $('#otherKegiatan').html(data);
            }, error: function (jqXHR, textStatus, errorThrown) {
                console.log('Load data is error');
            }
        });
    }
    //load most populer kegiatan
	const _sidepopulerkegiatan = () => {
        let url = window.location.href,
        idp_kegiatan = url.split('/')[4],
        i,
        widgetContent = '';
        for (i = 0; i < 4; i++) {
            widgetContent += `<div class="col-lg-12 mb-6">
            <div class="d-flex align-items-center">
                <!--begin::Symbol-->
                <a href="javascript:void(0);" class="symbol symbol-70 flex-shrink-0 mr-5">
                    <img src="`+imageLoader+`" alt="">
                </a>
                <!--end::Symbol-->
                <!--begin::Text-->
                <div class="d-flex flex-column flex-grow-1">
                    <h5 class="placeholder-glow mb-0">
                        <span class="placeholder col-12 rounded"></span>
                    </h5>
                    <small class="title placeholder-glow">
                        <span class="placeholder col-6 rounded"></span>
                    </small>
                    <h5 class="placeholder-glow mb-0">
                        <span class="placeholder col-12 rounded"></span>
                    </h5>
                    <small class="title placeholder-glow">
                        <span class="placeholder col-6 rounded"></span>
                    </small>
                </div>
                <!--end::Text-->
            </div>
        </div>`;
        }
        $('#kegiatanPopuler').append(widgetContent);
        $.ajax({
            url: BASE_URL+ "/front/load_populer_kegiatan",
            headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
            type: 'GET',
            dataType: 'JSON',
            data: {
                idp_kegiatan
            },
            success: function (data) {
                $('#kegiatanPopuler').html(data);
            }, error: function (jqXHR, textStatus, errorThrown) {
                console.log('Load data is error');
            }
        });
    }
    // Public Functions
    return {
        // public functions
        init: function() {
            _sideotherkegiatan();
            _sidepopulerkegiatan();
        }
    };
}();
// Class Initialization
jQuery(document).ready(function() {
    loadApp.init();
});