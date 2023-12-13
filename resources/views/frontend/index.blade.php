@extends('frontend.layouts', ['activeMenu' => 'BERANDA', 'activeSubMenu' => '',  'page' => 'beranda', 'title' => 'Alumni'])
@section('content')
@if((new \Jenssegers\Agent\Agent())->isMobile())
<!--begin::Container Mobile Banner-->
<div class="container justify-content-center py-2">
    <!--begin::HeadBanner Center-->
    <div class=" d-lg-flex row">
        <div class="col-lg-12">
            <!--begin::Logo-->
            <a href="" class="" id="sectionBannerMobile">
                <img alt="banner" src="{{ asset('dist/img/placeholder_banner.jpg') }}" class="w-100 rounded">
            </a>
            <!--end::Logo-->
        </div>
    </div>
    <!--end::HeadBanner Center-->
</div>
<!--end::Container Mobile Banner-->
@endif
<div class="card">
    <!--begin::Data Alumni-->
    <div class="container" id="sectionDataAlumni" style="padding-top: 10%">
        <div class="card-title text-center ">
            <h3 class="card-label font-weight-boldest text-underline"> DATA ALUMNI</h3>
        </div>
        <div class="form-group mt-2" id="iGroup-Status">
            <small class="form-text text-muted"><i class="bi bi-search mr-2 align-center"></i> Filter berdasarkan jurusan </small>
            <select id="dt-filterJurusan" name="dt-filterJurusan" class="form-control selectpicker show-tick" data-live-search="true" title="Pilih jurusan..."></select>
        </div>
        <div class="col-md-12 text-center mb-6" id="textEmptyJurusan">
            <p class="font-weight-bolder">Pilih jurusan terlebih dahulu untuk menampilkan data...</p>
        </div>
        <div class="card-body" id="tableDataAlumni" style="display: none;">
            <div class="table-responsive">
                <table id="dt-alumni" class="table table-hover table-bordered table-head-custom dtr-inline w-100">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center align-middle">No.</th>
                            <th class="align-middle">NOTAR</th>
                            <th class="align-middle">NAMA LENGKAP</th>
                            <th class="align-middle text-center">ANGKATAN</th>
                            <th class="align-middle text-center">JURUSAN</th>
                            <th class="align-middle text-center">INSTANSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!--end::Data Alumni-->
    <!--begin::Infografis-->
    <div class="container" id="sectionInfografis" style="padding-top: 10%">
        <div class="card-title text-center ">
            <h3 class="card-label font-weight-boldest text-underline"> INFOGRAFIS LULUSAN POLTRADA</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 ">
                <div id="pieChart"></div>
            </div>
            <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 ">
                <div class="row justify-content-center mt-2 mb-3">
                    <h4 class="font-weight-bolder">SEBARAN ALUMNI</h4>
                </div>
                <div id="map" style="height: 350px;"></div>
            </div>
        <div>
    </div>
    <!--end::Infografis-->
    <!--begin::Cekmydata-->
    <div class="container" id="sectionCekMyData" style="padding-top: 10%">
        <div class="card-title text-center ">
            <h3 class="card-label font-weight-boldest text-underline"> CEK DATAKU</h3>
        </div>
        <div class="alert alert-custom alert-success alert-shadow fade show gutter-b" role="alert">
            <div class="alert-icon">
                <span class="svg-icon svg-icon-light svg-icon-2x">
                    <i class="bi bi-megaphone-fill"></i>
                </span>
            </div>
            <div class="alert-text">   
                <span>ATURAN PENGECEKAN DATA ALUMNI POLTRADA SEBAGAI BERIKUT : GUNAKAN NIM/NOTAR SEBAGAI ACUAN PENCARIAN DATA DI PUSAT DATA ALUMNI POLTRADA. PASTIKAN KERAHASIAN DATA DIJAGA DENGAN BAIK DAN JANGAN BERIKAN DATA TERSEBUT KE ORANG YANG TIDAK DIKENAL.</span>
            </div>
        </div>
        <div class="col-lg-12  d-flex justify-content-center align-items-center">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-edit"></i></span>
                    </div>
                    <input type="text" id="cek_notar" name="cek_notar" class="form-control" placeholder="Isi nim/notar..." autocomplete="off">
                </div>
            </div>
            <div class="form-group ml-3">
                <button type="button" class="btn btn-info btn-sm waves-effect waves-light" id="btn-cekData" onclick="_confirmCekDataku()"><i class="icofont-search-2"></i> Cek dataku </button>
            </div>
        </div>
        <div class="container" id="pardonDataku" style="display: none"></div>
    </div>
    <!--end::Cekmydata-->
    <!--begin::kegiatan-->
    <div class="container more-kegiatan" id="sectionKegiatan" style="padding-top: 10%">
        <div class="card-title text-center ">
            <h3 class="card-label font-weight-boldest text-underline"> KEGIATAN</h3>
        </div>
        <div class="row justify-content-center">
            @foreach ($dtkegiatan as $kegiatan)
            @php
                $file_image = $kegiatan->thumbnail;
                if($file_image==''){
                    $url_file = asset('dist/img/default-placeholder.png');
                } else {
                    if (!file_exists(public_path(). '/dist/img/album-kegiatan/'.$file_image)){
                        $url_file = asset('dist/img/default-placeholder.png');
                        $file_image = NULL;
                    }else{
                        $url_file = url('dist/img/album-kegiatan/'.$file_image);
                    }
                }
            @endphp
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-2">
                <!--begin::Card-->
                <div class="card card-custom shadow rounded-top mb-5">
                    <div class="card-body p-0">
                        <!--begin::Image-->
                        <div class="overlay">
                            <a href="{{ url('/baca/'.$kegiatan->id.'/'.$kegiatan->slug.'') }}">
                                <div class="overlay-wrapper rounded bg-light text-center">
                                    <img src="{{ $url_file }}" alt="{{ $file_image }}" class="rounded-top w-100" style="height: 175px;" />
                                </div>
                                <div class="overlay-layer card-rounded">
                                    <span class="badge badge-dark"><i class="bi bi-eye fs-3 text-light"></i></span>
                                </div>
                            </a>
                        </div>
                        <!--end::Image-->
                        <!--begin::Details-->
                        <div class="text-center mt-5 mb-md-0 mb-lg-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column" style="height: 100px;">
                            <div class="mb-2">
                                <small class="text-muted mr-4"><i class="bi bi-alarm me-1 align-middle"></i>
                                    {{ App\Helpers\Shortcut::tanggalLower($kegiatan->tgl_post) }} {{ App\Helpers\Shortcut::TimeStamp($kegiatan->created_at) }} 
                                </small>
                                <small class="text-muted"><i class="bi bi-eye me-1 align-middle"></i> {{ $kegiatan->views }}x dilihat</small>
                            </div>
                            <a href="{{ url('/baca/'.$kegiatan->id.'/'.$kegiatan->slug.'') }}" class="text-dark font-weight-bold pr-2 pl-2">{{ Str::limit($kegiatan->judul, 100) }}</a>
                        </div>
                        <!--end::Details-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            @endforeach
        </div>
        <div class="row justify-content-center pb-20">
            {{ $dtkegiatan->links('vendor.pagination.kegiatan') }}
        </div>
    </div>
    <!--end::kegiatan-->
</div>
<!--begin View Modal Sebaran Alumni-->
<div class="modal fade" id="viewModalSebaranAlumni" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="scroll scroll-pull" data-scroll="true" data-height="400">
                    <!-- begin:Table Alumni View-->
                    <div class="row justify-content-center">
                        <div class="container">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="dt-modalAlumni" class="table table-hover table-bordered table-head-custom dtr-inline w-100">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center align-middle">No.</th>
                                                <th class="align-middle">NOTAR</th>
                                                <th class="align-middle">NAMA LENGKAP</th>
                                                <th class="align-middle text-center">ANGKATAN</th>
                                                <th class="align-middle text-center">JURUSAN</th>
                                                <th class="align-middle text-center">INSTANSI</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:Table Alumni View-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal"><i aria-hidden="true" class="ki ki-close"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--end View Modal Sebaran Alumni-->
@section('js')
<script>
    var image = '{{ asset("dist/img/marker-alumni.png") }}';
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript" src="{{ asset('script/frontend/main.js') }}"></script>    
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXSESO13hs0eNGVv9_Q8Ynbf0NcU4chIg&callback=initMap" async defer></script>
@stop
@endsection
