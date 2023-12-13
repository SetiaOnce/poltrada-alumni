"use strict";
// Class Definition
// FORM CLASS LOGIN
var KTLogin = function() {
    var _login;
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
	// input mask tanggal lahir
	$("#notar").mask("0000000000");
	$("#tgl_lahir").mask("00/00/0000", {
		placeholder: "dd/mm/yyyy"
	});
	var _handleSignInForm = function() {
		// Handle submit button
        $('#btn-login-submit').on('click', function (e) {
            e.preventDefault();
			$('#btn-login-submit').addClass('spinner spinner-white spinner-right').html('Mohon tunggu...');
			$('#btn-login-submit').attr('disabled', true);
			_blockUiPages('1');

			let  notar = $('#notar'), tgl_lahir = $('#tgl_lahir');
			if (notar.val() == '') {
				toastr.error('Notar masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
				notar.focus();
				$('#btn-login-submit').removeClass('spinner spinner-white spinner-right').html('<i class="fas fa-sign-in-alt"></i> Login');
				$('#btn-login-submit').attr('disabled', false);
				_blockUiPages('0');
				return false;
			} if(tgl_lahir.val() == ''){
				toastr.error('Tanggal lahir masih kosong...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
				tgl_lahir.focus();
				$('#btn-login-submit').removeClass('spinner spinner-white spinner-right').html('<i class="fas fa-sign-in-alt"></i> Login');
				$('#btn-login-submit').attr('disabled', false);
				_blockUiPages('0');
				return false;
			}if(!ValidDateFormat(tgl_lahir.val())){
				toastr.error('Format tanggal lahir tidak sesuai, format (Tanggal/Bulan/Tahun)...', 'Uuppss!', {"progressBar": true, "timeOut": 1500});
				tgl_lahir.focus();
				$('#btn-login-submit').removeClass('spinner spinner-white spinner-right').html('<i class="fas fa-sign-in-alt"></i> Login');
				$('#btn-login-submit').attr('disabled', false);
				_blockUiPages('0');
				return false;
			}

			let formData = new FormData($('#dt-formLogin')[0]), ajax_url= BASE_URL+ "/request_login_alumni";
			$.ajax({
				url: ajax_url,
				headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				dataType: "JSON",
				success: function (data) {
					$('#btn-login-submit').removeClass('spinner spinner-white spinner-right').html('<i class="fas fa-sign-in-alt"></i> Login');
					$('#btn-login-submit').attr('disabled', false);
					_blockUiPages('0');
					if (data.status==true){
						window.location.href = BASE_URL+ "/app_alumni/dashboard"
					}else if(data.notFound){
						Swal.fire({title: "Ooops!", text: "Notar atau tanggal lahir tidak sesuai!", icon: "warning", allowOutsideClick: false});
					}else{
						Swal.fire({title: "Ooops!", text: "Gagal Login, Periksa form inputan yang tersedia!.", icon: "error", allowOutsideClick: false});
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					$('#btn-login-submit').removeClass('spinner spinner-white spinner-right').html('<i class="fas fa-sign-in-alt"></i> Login');
					$('#btn-login-submit').attr('disabled', false);
					_blockUiPages('0');
					Swal.fire({title: "Ooops!", text: "Terjadi kesalahan yang tidak diketahui, mohon hubungi pengembang!", icon: "error"
					}).then(function (result) {
						// location.reload(true);
					});
				}
			});
		});
	}
    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');
            _handleSignInForm();
        }
    };
}();
// SITE INFO
var loadSiteInfo = function() {
	// Public Functions
	return {
		// public functions
		init: function() {
			$.ajax({
				url: base_url+ "load_info_login_alumni/",
				type: "GET",
				dataType: "JSON",
				success: function (data) {
					var headPagesLoginInfo=`<a href="` +base_url+ `" title="LOGIN - ` +data.name_site+ `">
						<img src="` +data.url_logologinhead+ `" class="max-h-50px" alt="logo-login">
					</a>`;
					$('#headPagesLoginInfo').html(headPagesLoginInfo);
					$('#ttlLogin').html('<h3 class="font-weight-boldest display-5 text-dark mt-3 mb-0" style="letter-spacing: 2px;">LOGIN</h3>');
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log('Load data is error');
				}
			});
		}
	};
}();
function ValidDateFormat(dateString) {
	const pattern = /^(\d{2})\/(\d{2})\/(\d{4})$/;
	return pattern.test(dateString);
}
// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init(), loadSiteInfo.init();
});
