"use strict";
// Perfect ScrollBar Pages
var _initScroll = function() {
    $('[data-scroll="true"]').each(function() {
        var el = $(this);

        KTUtil.scrollInit(this, {
            mobileNativeScroll: true,
            handleWindowResize: true,
            rememberPosition: (el.data('remember-position') == 'true' ? true : false)
        });
    });
}
// Block UI Pages
var _blockUiPages = function(onoff) {
	if(onoff=='1'){
		KTApp.blockPage({
			overlayColor: '#000000',
			state: 'primary',
			message: 'Mohon tunggu...',
		});
	}else{
		KTApp.unblockPage();
	}
}
// Block UI Modal
var _blockUiModal = function(onoff, elementID) {
	if(onoff=='1'){
		KTApp.block(elementID+ ' .modal-content', {
			overlayColor: '#000000',
			state: 'primary',
			message: 'Mohon tunggu...',
		});
	}else{
		KTApp.unblock(elementID+ ' .modal-content');
	}
}
//Validate Email
function validateEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
// SYSTEM INFO
var loadSystemInfo = function() {
	// Public Functions
	return {
		// public functions
		init: function() {
			$.ajax({
				url: base_url+ "common/ajax_get_siteinfo/",
				type: "GET",
				dataType: "JSON",
				success: function (data) {
					$('#kt_header .logoHeaderTop').html(`<img alt="Logo" src="` +data.siteInfo.url_logobackendhead+ `" class="max-h-35px" />`),
					$('#kt_header_mobile .logoHeaderTopMobile').html(`<img alt="Logo" src="` +data.siteInfo.url_logobackendhead+ `" class="max-h-30px" />`);
					$('#kt_footer .footerCopyright').html(`<div class="text-dark order-2 order-md-1">` +data.siteInfo.copyright_site+ `</div>`);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log('Load data error!');
				}
			});
		}
	};
}();
// USER INFO
var loadUserInfo = function() {
	// Public Functions
	return {
		// public functions
		init: function() {
			$.ajax({
				url: base_url+ "common/ajax_get_userinfo/",
				type: "GET",
				dataType: "JSON",
				success: function (data) {
					if(data.login==true){
						/*User Toolbar*/
						var userThumb=`<span class="symbol-label font-size-h5">` +data.symbolThumb+ `</span>
						<i class="symbol-badge bg-success"></i>`;
						if(data.user_thumb=='' || data.user_thumb==null){
							userThumb=`<span class="symbol-label font-size-h5">` +data.symbolThumb+ `</span>
							<i class="symbol-badge bg-success"></i>`;

						}else{
							userThumb=`<div class="symbol-label" style="background-image: url('` +data.url_userthumb+ `')"></div>
							<i class="symbol-badge bg-success"></i>`;
						}
						var divUser=`<div class="d-flex flex-column text-right pr-sm-3">
							<span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-sm-inline">` +data.username+ `</span>
							<span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline">` +data.levelName+ `</span>
						</div>
						<span class="symbol symbol-light-dark symbol-35">` +userThumb+ `</span>`;
						$('#kt_quick_user_toggle').html(divUser), $('#kt_quick_user_mobile_toggle').html(divUser);

						/*User SideRight*/
						var userThumbSide=`<span class="symbol-label font-size-h1">` +data.symbolThumb+ `</span>`;
						if(data.user_thumb=='' || data.user_thumb==null){
							userThumbSide=`<span class="symbol-label font-size-h1">` +data.symbolThumb+ `</span>`;
						}else{
							userThumbSide=`<div class="symbol-label" style="background-image:url('` +data.url_userthumb+ `')"></div>`;
						}

						var userMailSide=`<a href="` +base_url+ `app_admin/#/profilsaya" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">` +data.username+ `</a>
						<div class="text-muted mt-1"> `+data.levelName+` </div>
						<div class="navi mt-2">
							<a href="javascript:void(0);" class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-icon mr-1">
										<span class="svg-icon svg-icon-lg svg-icon-primary">
											<!--begin::Svg Icon | path:/metronic/theme/html/demo7/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
													<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</span>
									<span class="navi-text text-muted text-hover-primary">` +data.email+ `</span>
								</span>
							</a>
						</div>`;
						$('#kt_quick_user h3.nameUser').html(data.nama_lengkap), $('#kt_quick_user .symbolThumbSideRight').html(userThumbSide), $('#kt_quick_user .userMailSideRight').html(userMailSide);
					}else{
						var linkUrl = base_url+'logout';
						window.location = linkUrl;
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log('Load data error!');
				}
			});
		}
	};
}();
//Upload Image to Local Server with Summernote JS
var _uploadFile_editor = function(image, idCustom) {
	var data = new FormData();
	data.append("image", image);
	$.ajax({
		url: base_url+ "app_admin/ajax_upload_imgeditor",
        headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
		data: data,
		type: "POST",
		cache: false,
        contentType: false,
        processData: false,
        dataType: "JSON",
		success: function(data){
			if(data.status){
				if(idCustom){
					$(idCustom).summernote("insertImage", data.url_img);
				}else{
					$('.summernote').summernote("insertImage", data.url_img);
				}
			}else{
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
		}, error: function (jqXHR, textStatus, errorThrown, data) {
			console.log('Error upload images to text editor');
			toastr.error(errorThrown+ ', <br />' +jqXHR.responseJSON.errors.image[0], 'Uuppss!', {"progressBar": true, "timeOut": 1500});
		}
	});
};
// Class Initialization
jQuery(document).ready(function() {
	//Logout Otomatis After 30 Menit
	var inactivityTimeout = false;
	resetTimeout();
	function onUserInactivity() {
		Swal.fire({title: "Warning!",
			text: "Tidak ada aktivitas selama 30 Menit pada sistem. Logout otomatis 10 detik dari sekarang!",
			icon: "warning", timer: 10000, showCancelButton: false, showConfirmButton: false
		}).then(function (result) {
			window.location = base_url+ "logout";
		});
	}
	function resetTimeout() {
		clearTimeout(inactivityTimeout);
		inactivityTimeout = setTimeout(onUserInactivity, 10000 * 180); //30 Menit
	}
	window.onmousemove = resetTimeout;
	//Logout Otomatis After 30 Menit End

	/* [ Show pass ] */
	var showPass = 0;
	$(document).on("mouseenter mouseleave", ".btn-show-pass", function (e) {
		if (e.type == "mouseenter") {
			$('.password').attr('type', 'text');
			$('.eye').removeClass('far fa-eye-slash').addClass('far fa-eye');
			$('.btn-show-pass').attr('title', 'Tampilkan password');
			showPass = 1;
		} else {
			$('.password').attr('type', 'password');
			$('.eye').removeClass('far fa-eye').addClass('far fa-eye-slash');
			$('.btn-show-pass').attr('title', 'Sembunyikan password');
			showPass = 0;
		}
	});
});
/*************************
    ANGULAR ROUTER APP
*************************/
var routerApp = angular.module('routerApp', ['ui.router']);
routerApp.config(function ($stateProvider, $urlRouterProvider) {
	$urlRouterProvider.otherwise('/');
	$stateProvider
	//Beranda
	.state('/', {
		url: '/',
		templateUrl: 'beranda',
		onEnter: function ($window, $http) {
			_blockUiPages(1);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Beranda - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-beranda').addClass('menu-item-active'),
					$('#kt_body').removeClass('subheader-enabled'), $('#kt_subheader').hide(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5">Beranda</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted"><i class="flaticon-home-1"></i></a></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	.state('beranda', {
        url: '/beranda',
		templateUrl: 'beranda',
		onEnter: function ($window, $http) {
			_blockUiPages(1);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Beranda - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-beranda').addClass('menu-item-active'),
					$('#kt_body').removeClass('subheader-enabled'), $('#kt_subheader').hide(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5">Beranda</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted"><i class="flaticon-home-1"></i></a></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Pendataan: Data Keahlian
	.state('datakeahlian', {
		url: '/datakeahlian',
		templateUrl: 'datakeahlian',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola Data Bidang Keahlian - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-pendataan, #kt_header_menu .menu-item-pendataan ul.menu-subnav .submenu-item-dtkeahlian').addClass('menu-item-open menu-item-here'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="flaticon-list-2 text-dark"></i> Kelola Data Bidang Keahlian</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Pendataan</a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Bidang Keahlian</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Pendataan: Data Asesor
	.state('dataasesor', {
		url: '/dataasesor',
		templateUrl: 'dataasesor',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola Data Asesor - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-pendataan, #kt_header_menu .menu-item-pendataan ul.menu-subnav .submenu-item-dtasesor').addClass('menu-item-open menu-item-here'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="flaticon2-group text-dark"></i> Kelola Data Asesor</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Pendataan</a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Asesor</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Pendataan: Data Skema Sertifikasi
	.state('dataskemasertifikasi', {
		url: '/dataskemasertifikasi',
		templateUrl: 'dataskemasertifikasi',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola Data Skema Sertifikasi - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-pendataan, #kt_header_menu .menu-item-pendataan ul.menu-subnav .submenu-item-dtskemasertifikasi').addClass('menu-item-open menu-item-here'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="flaticon-list-2 text-dark"></i> Kelola Data Skema Sertifikasi</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Pendataan</a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Skema Sertifikasi</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Pendataan: Data Lokasi Uji Kompetensi
	.state('datalokasiuji', {
		url: '/datalokasiuji',
		templateUrl: 'datalokasiuji',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola Data Lokasi Uji Kompetensi - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-pendataan, #kt_header_menu .menu-item-pendataan ul.menu-subnav .submenu-item-dtlokasiuji').addClass('menu-item-open menu-item-here'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="flaticon2-map text-dark"></i> Kelola Data Lokasi Uji Kompetensi</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Pendataan</a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Lokasi Uji Kompetensi</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//GALERI KEGIATAN
	.state('galerikegiatan', {
		url: '/galerikegiatan',
		templateUrl: 'galerikegiatan',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola konten galeri kegiatan LSP PTDI-STTD - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-galerikegiatan').addClass('menu-item-active'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="far fa-images text-dark"></i> Kelola Konten Galeri Kegiatan LSP PTDI-STTD</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Galeri Kegiatan</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Profil LSP
	.state('profillsp', {
        url: '/profillsp',
		templateUrl: 'profillsp',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola Profil LSP PTDI-STTD - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-profillsp').addClass('menu-item-active'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="flaticon-cogwheel-2 text-dark"></i> Kelola Profil LSP PTDI-STTD</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Profil LSP</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Data Regulasi
	.state('dataregulasi', {
		url: '/dataregulasi',
		templateUrl: 'dataregulasi',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola Data Regulasi LSP PTDI-STTD - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-regulasi').addClass('menu-item-active'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="fas fa-book text-dark"></i> Kelola Data Regulasi</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Regulasi</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Website Info - Pengaturan
	.state('websiteinfo', {
        url: '/websiteinfo',
		templateUrl: 'websiteinfo',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola Informasi Website LSP PTDI-STTD - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-pengelolaanwebsite, #kt_header_menu .menu-item-pengelolaanwebsite ul.menu-subnav .submenu-item-websiteinfo').addClass('menu-item-open menu-item-here'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="flaticon2-website text-dark"></i> Kelola Informasi Website</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Pengaturan</a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Informasi website</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Link Terkait - Pengaturan
	.state('linkterkait', {
        url: '/linkterkait',
		templateUrl: 'linkterkait',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola konten Link Terkait - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-pengelolaanwebsite, #kt_header_menu .menu-item-pengelolaanwebsite ul.menu-subnav .submenu-item-linkterkait').addClass('menu-item-open menu-item-here'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="la la-link text-dark"></i> Kelola konten Link Terkait</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Pengaturan</a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Link Terkait</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Data FAQ - Pengaturan
	.state('datafaq', {
        url: '/datafaq',
		templateUrl: 'datafaq',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola data Frequently Asked Questions (FAQ) - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-pengelolaanwebsite, #kt_header_menu .menu-item-pengelolaanwebsite ul.menu-subnav .submenu-item-faq').addClass('menu-item-open menu-item-here'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="la la-question text-dark"></i> Kelola data FAQ</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Pengaturan</a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Frequently Asked Questions (FAQ)</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Data User
	.state('datauser', {
		url: '/datauser',
		templateUrl: 'datauser',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola Data User - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-datauser').addClass('menu-item-active'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="fas fa-users text-dark"></i> Kelola Data User</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><span class="text-muted">User System</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Users - Log Aktivitas User
	.state('logactivity', {
        url: '/logactivity',
		templateUrl: 'logactivity',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Log Aktivitas User - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_header_menu .menu-item-logactivity').addClass('menu-item-active'),
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5"><i class="la la-history text-dark"></i> Log Aktivitas User</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Log Activity</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})
	//Users - Profil Saya
	.state('profilsaya', {
        url: '/profilsaya',
		templateUrl: 'profilsaya',
		onEnter: function ($window, $http) {
			_blockUiPages(0);
			$http.get(base_url+ 'common/ajax_getangularinfo/').then(function (response) {
				if(response.data.login==true){
					//console.log(response.data.siteInfo);
					var levelName;
					if(response.data.userInfo.fid_level==1){levelName='Administrator';}else{levelName='-';}
					$window.document.title = "Kelola Profil Saya - " +levelName+ " - " + response.data.sistemInfo.name_site;
					removenavclass(), $('#kt_body').removeAttr("data-offcanvas-offcanvas"), $('#kt_quick_user').removeClass('offcanvas-on'), $('.offcanvas-overlay').remove();
					$('#kt_body').addClass('subheader-enabled'), $('#kt_subheader').show(), $('#kt_subheader .titlePageBreadcrumb').html(`<h5 class="text-dark font-weight-bold my-1 mr-5">
					<span class="svg-icon svg-icon-md svg-icon-dark">
						<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo7/dist/../src/media/svg/icons/Communication/Write.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24"/>
								<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
								<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span> Kelola Profil Saya</h5>`),
					$('#kt_subheader ul.breadcrumb').html(`<li class="breadcrumb-item text-muted"><a href="` +base_url+ `app_admin/" class="text-muted"><i class="flaticon-home-1"></i></a></li><li class="breadcrumb-item text-muted"><a href="javascript:void(0);" class="text-muted">Users</a></li><li class="breadcrumb-item text-muted"><span class="text-muted">Profil Saya</span></li>`);
				}else{
					var linkUrl = base_url+'logout';
					window.location = linkUrl;
				}
			});
			loadSystemInfo.init(), loadUserInfo.init(), $('[data-toggle="tooltip"]').tooltip('dispose'), $('.tooltip').hide(), _blockUiPages(0);
		}
	})

	.state('404', {
		url: '/404',
		template: '404!!! page is missing'
	});

	//*******************
	/* Remove nav class */
	//*******************
	function removenavclass() {
		$('#kt_header_menu ul.menu-nav li').removeClass('menu-item-active'), $('#kt_header_menu ul.menu-nav li').removeClass('menu-item-open-dropdown menu-item-hover'),
		$('#kt_header_menu ul.menu-nav li, #kt_header_menu ul.menu-nav li.menu-item-submenu ul.menu-subnav li').removeClass('menu-item-open menu-item-here');
		$('#kt_body').removeAttr("data-offcanvas-header-navs"), $('#kt_header_navs').removeClass('header-navs-on'), $('.header-navs-overlay').remove(), $('#kt_header_mobile_toggle').removeClass('burge-icon-active');
	}
});
/*************************
    ANGULAR ROUTER APP END
*************************/