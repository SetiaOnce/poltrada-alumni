<!--begin::Javascript-->
<script>
    var hostUrl = "{{ asset('/dist/') }}";
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!--begin::Global Config(global config for global JS scripts)-->
<script type="text/javascript">var KTAppSettings={"breakpoints":{"sm":576,"md":768,"lg":992,"xl":1200,"xxl":1400},"colors":{"theme":{"base":{"white":"#ffffff","primary":"#3699FF","secondary":"#E5EAEE","success":"#1BC5BD","info":"#8950FC","warning":"#FFA800","danger":"#F64E60","light":"#E4E6EF","dark":"#181C32"},"light":{"white":"#ffffff","primary":"#E1F0FF","secondary":"#EBEDF3","success":"#C9F7F5","info":"#EEE5FF","warning":"#FFF4DE","danger":"#FFE2E5","light":"#F3F6F9","dark":"#D6D6E0"},"inverse":{"white":"#ffffff","primary":"#ffffff","secondary":"#3F4254","success":"#ffffff","info":"#ffffff","warning":"#ffffff","danger":"#ffffff","light":"#464E5F","dark":"#ffffff"}},"gray":{"gray-100":"#F3F6F9","gray-200":"#EBEDF3","gray-300":"#E4E6EF","gray-400":"#D1D3E0","gray-500":"#B5B5C3","gray-600":"#7E8299","gray-700":"#5E6278","gray-800":"#3F4254","gray-900":"#181C32"}},"font-family":"Poppins"};</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script type="text/javascript" src="{{ asset('dist/plugins/global/plugins.bundle.js?v=7.2.8') }}"></script>
<!-- angular-js -->
<script type="text/javascript" src="{{ asset('dist/plugins/angular-1.2.13/angular.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/plugins/AngularUI/ui-router.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/plugins/pace/pace.min.js') }}"></script>
<!-- Bundle-js -->
<script type="text/javascript" src="{{ asset('dist/js/scripts.bundle.js?v=7.2.8') }}"></script>
<!--end::Global Theme Bundle-->
<!-- module-js -->
<script type="text/javascript" src="{{ asset('dist/plugins/summernote-0.8.18/summernote-bs4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/plugins/summernote-0.8.18/lang/summernote-id-ID.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/plugins/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/plugins/dropify-master/js/dropify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/plugins/bootstrap-file-input/js/plugins/piexif.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/plugins/bootstrap-file-input/js/plugins/sortable.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/plugins/bootstrap-file-input/js/fileinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/plugins/bootstrap-file-input/themes/fas/theme.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/plugins/bootstrap-file-input/themes/explorer-fas/theme.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/plugins/Magnific-Popup/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/js/app_admin.init.js?v=7.2.8') }}"></script>
<script type="text/javascript" src="{{ asset('script/frontend/info_system.js') }}"></script>
@yield('js')
<!--end::Vendors Javascript-->
<!--end::Javascript-->