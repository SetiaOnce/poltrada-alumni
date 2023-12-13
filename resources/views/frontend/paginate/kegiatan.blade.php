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
<div class="row justify-content-center">
    {{ $dtkegiatan->links('vendor.pagination.kegiatan') }}
</div>