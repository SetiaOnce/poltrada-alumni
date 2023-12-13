<!-- Datatable Source -->
<link href="{{ asset('dist/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
<!-- Upload css -->
<link href="{{ asset('dist/plugins/dropify-master/css/dropify.min.css') }}" rel="stylesheet">
<link href="{{ asset('dist/plugins/bootstrap-file-input/css/fileinput.min.css') }}" rel="stylesheet">
<link href="{{ asset('dist/plugins/bootstrap-file-input/themes/explorer-fas/theme.css') }}" rel="stylesheet">
<!-- Magnific Popup Source -->
<link href="{{ asset('dist/plugins/Magnific-Popup/magnific-popup.css') }}" rel="stylesheet">
<!--begin::Global Theme Styles(used by all pages)-->
<link href="{{ asset('dist/plugins/global/plugins.bundle.css?v=7.2.8') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dist/css/style.bundle.css?v=7.2.8') }}" rel="stylesheet" type="text/css" />
<!-- Bootstrap 4 Summernote css -->
<link href="{{ asset('dist/plugins/summernote-0.8.18/summernote-bs4.min.css') }}" rel="stylesheet">
<!-- pace load css -->
<link href="{{ asset('dist/plugins/pace/themes/blue/pace-theme-flash.css') }}" rel="stylesheet" />
<!-- cdn -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<!-- custom css -->
<link href="{{ asset('dist/css/custom.init.css') }}" rel="stylesheet" />
<!--end::Global Theme Styles-->
@yield('css')
<script src="{{ asset('/dist/js/base_route.js') }}"></script>
<script>
    var BASE_URL = "{{url('/')}}";
</script> 