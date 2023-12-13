@extends('frontend.layouts', ['activeMenu' => 'DETAIL_KEGIATAN', 'activeSubMenu' => '', 'page' => 'detail', 'title' => 'Baca Kegiatan'])
@section('content')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/plugins/bootstrap-5.3.0-alpha3/css/bootstrap.min.css') }}">
@stop
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mt-4">
            <div class="card card-custom gutter-b">
                <div class="card-header ribbon ribbon-right">
                    <h3 class="card-title">
                        <i class="bi bi-bookmark-fill me-2 align-middle"></i>{{ $kegiatan->judul }}
                    </h3>
                </div>
                <div class="card-body">
                    <div id="elementImage">
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
                        <a class="d-block overlay w-100 image-popup" href="javascript:void(0);" title="{{ $file_image }}">
                            <img src="{{ $url_file }}" class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover rounded w-100" alt="{{ $file_image }}" />
                        </a>
                        <div class="row justify-content-center d-flex mt-4">
                            <span class="text-muted">
                                <i class="bi bi-alarm me-1 align-middle"></i>
                                {{ App\Helpers\Shortcut::tanggalLower($kegiatan->tgl_post) }} {{ App\Helpers\Shortcut::TimeStamp($kegiatan->created_at) }} 
                            </span>
                            <span class="text-muted"><i class="bi bi-eye me-1 align-middle"></i> {{ $kegiatan->views }}x dilihat</span>
                        </div>
                    </div>
                    <div id="elementDescription" class="font-weight-normal text-justify mt-6">
                        {!!  $kegiatan->isi !!}
                    </div>
                    <hr>
                    <div id="elementTags" class="mb-3">
                        @foreach ($dtkeyword as $keyword)
                        <span class="label label-secondary label-inline mr-1 mb-2">#{{$keyword}}</span>
                        @endforeach
                    </div>
                    <div class="row justify-content-left" id="elementImageKegiatan">
                        @foreach ($dtKegiatanAlbum as $album)
                        @php
                            $file_image = $album->file_name;
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
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 mb-2">
                            <!--begin::Card-->
                            <a class="d-block overlay w-100 image-popup" href="{{ $url_file }}" title="{{ $album->caption }}" subtitle="{{ $kegiatan->judul }}">
                                <img src="{{ $url_file }}" class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover rounded w-100" alt="{{ $file_image }}" />
                                <div class="overlay-layer card-rounded ">
                                    <span class="badge badge-dark"><i class="las la-search fs-3 text-light"></i></span>
                                </div>    
                            </a>
                            <!--end::Card-->
                        </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="card-toolbar">
                        <a href="https://api.whatsapp.com/send?text={{ url('/baca/'.$kegiatan->id.'/'.$kegiatan->slug.'') }}" target="_blank" class="btn btn-icon btn-sm btn-success mr-1" data-toggle="tooltip" data-placement="top" title="Share whatsapp">
                            <i class="bi bi-whatsapp icon-nm"></i>
                        </a>
                        <a href="https://twitter.com/share?url={{ url('/baca/'.$kegiatan->id.'/'.$kegiatan->slug.'') }}"  target="_blank" class="btn btn-icon btn-sm btn-twitter mr-1" data-toggle="tooltip" data-placement="top" title="Share twitter">
                            <i class="bi bi-twitter icon-nm"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('/baca/'.$kegiatan->id.'/'.$kegiatan->slug.'') }}" target="_blank" class="btn btn-icon btn-sm btn-facebook" data-toggle="tooltip" data-placement="top" title="Share facebook">
                            <i class="bi bi-facebook icon-nm"></i>
                        </a>
                    </div>
                    <a href="javascript:history.back()" class="btn btn-danger btn-lg btn-block mt-4"><i class="bi bi-backspace align-middle"></i> Kembali ke halaman sebelumnya</a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-4">
            <div class="card card-custom gutter-b">
                <div class="card-header ribbon ribbon-right">
                    <div class="ribbon-target bg-info" style="top: 10px; right: -2px;">Kegiatan Lainnya</div>
                </div>
                <div class="card-body" id="otherKegiatan"></div>
            </div>
            <div class="card card-custom gutter-b">
                <div class="card-header ribbon ribbon-right">
                    <div class="ribbon-target bg-info" style="top: 10px; right: -2px;">Kegiatan Terpopuler</div>
                </div>
                <div class="card-body" id="kegiatanPopuler"></div>
            </div>
        </div>
    </div>
</div>
@section('js')  
<script>var imageLoader = "{{ asset('dist/img/sample-background-login-750x500px.jpg') }}";</script>  
<script type="text/javascript" src="{{ asset('script/frontend/detail_kegiatan.js') }}"></script>    
@stop
@endsection
