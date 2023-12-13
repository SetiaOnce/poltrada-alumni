<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Shortcut;
use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\KegiatanAlbum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class KegiatanController extends Controller
{
    public function index()
    {
        if(!session()->get('login_akses')) { 
            return redirect('/login'); 
        }
        return  view('backend.kegiatan');
    }
    public function data(Request $request)
    {

        if($request->input('filter') == 5){
            $data = Kegiatan::latest()->whereNotIn('status', [100])->get();
        }else{
            $data = Kegiatan::latest()->where('status', $request->input('filter'))->get();
        }
        return Datatables::of($data)->addIndexColumn()
            ->editColumn('thumnail', function ($row) {
                $file_image = $row->thumbnail;
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

                $fileCustom = '<a class="d-block overlay w-100 image-popup" href="'.$url_file.'" title="'.$file_image.'">
                    <img src="'.$url_file.'" class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover rounded w-100" alt="'.$file_image.'" />
                    <div class="overlay-layer card-rounded ">
                        <span class="badge badge-dark"><i class="las la-search fs-3 text-light"></i></span>
                    </div>    
                </a>';
                return $fileCustom;
            })
            ->editColumn('data', function ($row) {
                if($row->status == 1) {
                    $judulPost = '<a class="text-dark-75 font-weight-bolder" href="'.url('/baca/'.$row->id.'/'.$row->slug.'').'" target="_blank" data-toggle="tooltip" title="Lihat konten kegiatan!">'. $row->judul .'</a>';
                } else {
                    $judulPost = '<a class="text-dark-75 font-weight-bolder" href="javascript:void(0);" onclick="preview_galeri('."'".$row->id."'".');" data-toggle="tooltip" title="Preview isi konten galeri kegiatan!">'. $row->judul .'</a>';
                }
                $output = $judulPost.' <br/><span class="text-muted"><em>'.$row->user_add.' <br />'. Shortcut::tanggalLower($row->tgl_post) .' '. Shortcut::TimeStamp($row->created_at).' WITA</em></span>';
                return $output;
            })
            ->editColumn('status', function ($row) {
                if($row->status == 0) {
                    $activeCustom = '<button type="button" class="btn btn-sm btn-danger font-weight-bold mb-1" data-toggle="tooltip" title="Postingan Tidak Aktif (DRAFT), Aktifkan ?" onclick="_updateStatus('."'".$row->id."'".', '."'1'".',  '."'status'".');"><i class="fas fa-toggle-off"></i></button>';
                } else if($row->status == 1){
                    $activeCustom = '<button type="button" class="btn btn-sm btn-info font-weight-bold mb-1" data-toggle="tooltip" title="Postingan Aktif (PUBLIK), Nonaktifkan ?" onclick="_updateStatus('."'".$row->id."'".', '."'0'".',  '."'status'".');"><i class="fas fa-toggle-on"></i></button>';
                } else {
                    $activeCustom = '<button type="button" class="btn btn-sm btn-warning font-weight-bold mb-1" data-toggle="tooltip" title="Data sampah!" disabled><i class="mdi mdi-delete-variant"></i></button>';
                }
                return $activeCustom;
            })
            ->addColumn('action', function($row){
                if($row->status == 100){
                    $action = '<button type="button" class="btn btn-block btn-sm btn-success font-weight-bold mb-1" data-toggle="tooltip" title="Kelola foto kegiatan!" onclick="kelola_galeri('."'".$row->id."'".');"><i class="mdi mdi-folder-multiple-image"></i> Kelola</button>
                    <button type="button" class="btn btn-block btn-sm btn-info font-weight-bold mb-1" data-toggle="tooltip" title="Kembalikan postingan kegiatan!" onclick="_updateStatus('."'".$row->id."'".', '."'1'".',  '."'restore'".');"><i class="mdi mdi-restore"></i> Restore</button>
                    <button type="button" class="btn btn-block btn-sm btn-danger font-weight-bold mb-1" data-toggle="tooltip" title="Hapus permanen postingan kegiatan!" onclick="_deleteKegiatanGaleri('."'".$row->id."'".');"><i class="mdi mdi-delete-empty"></i> Hapus</button>';
                }else{
                    $action = '<button type="button" class="btn btn-block btn-sm btn-success font-weight-bold mb-1" data-toggle="tooltip" title="Kelola foto kegiatan!" onclick="kelola_galeri('."'".$row->id."'".');"><i class="mdi mdi-folder-multiple-image"></i> Kelola</button>
                    <button type="button" class="btn btn-block btn-sm btn-dark font-weight-bold mb-1" data-toggle="tooltip" title="Edit postingan kegiatan!" onclick="_editKegiatan('."'".$row->id."'".');"><i class="la la-edit"></i> Edit</button>
                    <button type="button" class="btn btn-block btn-sm btn-warning font-weight-bold mb-1" data-toggle="tooltip" title="Buang postingan ke tempat sampah!" onclick="_updateStatus('."'".$row->id."'".', '."'100'".',  '."'sampah'".');"><i class="mdi mdi-delete-outline"></i> Sampah</button>';
                }
                return $action;
            })
            ->rawColumns(['thumnail','data','status', 'action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");

        $errors					= [];
        $validator = Validator::make($request->all(), [
            'judul_kegiatan' => 'required|max:250',
            'keyword_tag_kegiatan' => 'required',
            'isi_kegiatan' => 'required',
            'thumbnail' => 'required|mimes:png,jpg,jpeg|max:2048',
        ],[
            'judul_kegiatan.required' => 'Judul kegiatan masih kosong.',
            'judul_kegiatan.max' => 'Judul kegiatan tidak lebih dari 250 karakter.',
            'keyword_tag_kegiatan.required' => 'Keyword kegiatan masih kosong.',
            'isi_kegiatan.required' => 'Isi kegiatan masih kosong.',

            'thumbnail.required' => 'Thumbnail kegiatan tidak boleh kosong.',
            'thumbnail.max' => 'Thumbnail kegiatan tidak lebih dari 2MB.',
            'thumbnail.mimes' => 'Thumbnail kegiatan berekstensi jpg jepg png.',
        ]);
    
        if($validator->fails()){
            foreach ($validator->errors()->getMessages() as $item) {
                $errors[] = $item;
            }
            $output = array("status" => FALSE, "pesan_code" => 'format_inputan', "pesan_error" => $errors);
        } else {
            // parse date
            $newDate=Carbon::createFromFormat('d/m/Y', $request->input('tgl_post_kegiatan'))->format('Y-m-d'); 
            // slug
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->input('judul_kegiatan')))).'-'.strtolower(Shortcut::random_strings(15));
            // keyword
            $keyword = implode(", ", $request->input('keyword_tag_kegiatan'));
            // thumbnail
            $mainImage = $request->file('thumbnail');
            $filename = md5(Shortcut::random_strings(20)) . '.' . $mainImage->extension();
            Image::make($mainImage)->resize(1339,887)->save(public_path('dist/img/album-kegiatan/'.$filename));
            // save data
            Kegiatan::create([
                'judul' => $request->input('judul_kegiatan'),
                'keyword_tag' => $keyword,
                'isi' => $request->input('isi_kegiatan'),
                'slug' => $slug,
                'thumbnail' => $filename,
                'tgl_post' => $newDate,
                'user_add' => session()->get('nama'),
                'created_at' => Carbon::now()
            ]);
            $output = array("status" => TRUE);
        }
        return response()->json($output);
    }
    public function edit(Request $request)
    {
        $data_id = $request->input('idp');
        $dataKegiatan = Kegiatan::where('id', $data_id)->first();
        $tgl_post=Carbon::createFromFormat('Y-m-d', $dataKegiatan->tgl_post)->format('d/m/Y'); 

        $file_image = $dataKegiatan->thumbnail;
        if($file_image==''){
            $url_file = asset('dist/img/default-placeholder.png');
        } else {
            if (!file_exists(public_path(). '/dist/img/album-kegiatan/'.$file_image)){
                $url_file = asset('dist/img/default-placeholder.png');
            }else{
                $url_file = url('dist/img/album-kegiatan/'.$file_image);
            }
        }
        return response()->json([
            'status' => TRUE,
            'row' =>$dataKegiatan,
            'url_thumbnail' =>$url_file,
            'tgl_post' =>$tgl_post,
            'tagarray' => explode(',', $dataKegiatan->keyword_tag),
        ]);
    }
    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");

        $data_id = $request->input('id');
        $errors					= [];

        $validator = Validator::make($request->all(), [
            'judul_kegiatan' => 'required|max:250',
            'keyword_tag_kegiatan' => 'required',
            'isi_kegiatan' => 'required',
        ],[
            'judul_kegiatan.required' => 'Judul kegiatan masih kosong.',
            'judul_kegiatan.max' => 'Judul kegiatan tidak lebih dari 250 karakter.',
            'keyword_tag_kegiatan.required' => 'Keyword kegiatan masih kosong.',
            'isi_kegiatan.required' => 'Isi kegiatan masih kosong.',
        ]);
        if($validator->fails()){
            foreach ($validator->errors()->getMessages() as $item) {
                $errors[] = $item;
            }
            $output = array("status" => FALSE, "pesan_code" => 'format_inputan', "pesan_error" => $errors);
        } else {
            if($request->file('thumbnail')){
                $validator = Validator::make($request->all(), [
                    'thumbnail' => 'required|mimes:png,jpg,jpeg|max:2048',
                ],[
                    'thumbnail.required' => 'Thumbnail kegiatan tidak boleh kosong.',
                    'thumbnail.max' => 'Thumbnail kegiatan tidak lebih dari 2MB.',
                    'thumbnail.mimes' => 'Thumbnail kegiatan berekstensi jpg jepg png.',
                ]);
                if($validator->fails()){
                    foreach ($validator->errors()->getMessages() as $item) {
                        $errors[] = $item;
                    }
                    $output = array("status" => FALSE, "pesan_code" => 'format_inputan', "pesan_error" => $errors);
                } else {
                    // thumbnail
                    $mainImage = $request->file('thumbnail');
                    $filename = md5(Shortcut::random_strings(20)) . '.' . $mainImage->extension();
                    Image::make($mainImage)->resize(1339,887)->save(public_path('dist/img/album-kegiatan/'.$filename));
                    Kegiatan::where('id', $data_id)->update([
                        'thumbnail' => $filename,
                    ]);
                }
            }
            // parse date
            $newDate=Carbon::createFromFormat('d/m/Y', $request->input('tgl_post_kegiatan'))->format('Y-m-d'); 
            // slug
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->input('judul_kegiatan')))).'-'.strtolower(Shortcut::random_strings(15));
            // keyword
            $keyword = implode(", ", $request->input('keyword_tag_kegiatan'));
        
            Kegiatan::where('id', $data_id)->update([
                'judul' => $request->input('judul_kegiatan'),
                'keyword_tag' => $keyword,
                'isi' => $request->input('isi_kegiatan'),
                'slug' => $slug,
                'tgl_post' => $newDate,
                'status' => $request->input('status'),
                'user_updated' => session()->get('nama'),
                'updated_at' => Carbon::now()
            ]);
            $output = array("status" => TRUE);
        }

        return response()->json($output);
    }
    public function updateStatus(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");

        $data_id = $request->input('idp');
        $value = $request->input('value');
        $message = 'Kegiatan berhasil dinonaktifkan';
        if($value == 1){
            $message = 'Kegiatan berhasil diaktfikan';
        }else if($value == 100){
            $message = 'Kegiatan telah dipindahkan ke tempat sampah';
        }
        Kegiatan::where('id', $data_id)->update([
            'status' => $value,
            'user_updated' => session()->get('nama'),
            'updated_at' => Carbon::now()
        ]);

        return response()->json([
            'status' => TRUE,
            'message' => $message
        ]);
    }
    public function kegiatanDestroy(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");

        $data_id = $request->input('idp');
        Kegiatan::where('id', $data_id)->delete();
        KegiatanAlbum::where('fid_kegiatan', $data_id)->delete();
        return response()->json(['status' => TRUE]);
    }

    // ===>>> THIS BELLOW FOR KEGIATAN ALBUM FOR <<<===//
    public function loadGaleri(Request $request)
    {
        $idp_kegiatan = $request->input('idp_kegiatan');
        $query = KegiatanAlbum::where('fid_kegiatan', $idp_kegiatan)->get();
        $output = '';
        $output .= '';
        foreach($query as $row)
        {
            $file_image = $row->file_name;
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

            $output .='<!--begin::Col-->
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <!--begin::Card-->
                    <div class="card card-custom shadow rounded-top mb-5">
                        <div class="card-body p-0">
                            <!--begin::Image-->
                            <div class="overlay">
                                <div class="overlay-wrapper rounded bg-light text-center">
                                    <img src="'.$url_file.'" alt="'.$file_image.'" class="rounded-top w-100" style="height: 175px;" />
                                </div>
                                <div class="overlay-layer">
                                    <a href="'.$url_file.'" title="'.$row->kegiatan->judul.'" subtitle="'.$row->caption.'" class="btn font-weight-bolder btn-sm btn-primary mr-2 image-popup-fit lightbox"><i class="mdi mdi-image-search"></i> Lihat</a>
                                    <button onclick="remove_galerikegiatan_src('.$row->id.', '.$row->fid_kegiatan.');" class="btn font-weight-bolder btn-sm btn-light-danger"><i class="mdi mdi-image-remove"></i> Hapus</button>
                                </div>
                            </div>
                            <!--end::Image-->
                            <!--begin::Details-->
                            <div class="text-center mt-5 mb-md-0 mb-lg-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column" style="height: 62px;">
                                <span class="font-size-lg">'.$row->caption.'</span>
                            </div>
                            <!--end::Details-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
            <!--end::Col-->';
        }
        $output .= '';

        return response()->json(['galerikegiatan' => $output]);
    }
    public function saveFoto(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");

        $errors					= [];
        $validator = Validator::make($request->all(), [
            'file_name' => 'required|mimes:png,jpg,jpeg|max:2048',
            'caption_filekegiatan' => 'required|max:250',
        ],[
            'file_name.required' => 'Foto/Gambar galeri kegiatan tidak boleh kosong.',
            'file_name.max' => 'Foto/Gambar galeri kegiatan tidak lebih dari 2MB.',
            'file_name.mimes' => 'Foto/Gambar galeri kegiatan berekstensi jpg jepg png.',
            'caption_filekegiatan.max' => 'Caption galeri kegiatan tidak lebih dari 250 karakter.',
        ]);
    
        if($validator->fails()){
            foreach ($validator->errors()->getMessages() as $item) {
                $errors[] = $item;
            }
            $output = array("status" => FALSE, "pesan_code" => 'format_inputan', "pesan_error" => $errors);
        } else {
            $mainImage = $request->file('file_name');
            $filename = md5(Shortcut::random_strings(20)) . '.' . $mainImage->extension();
            Image::make($mainImage)->resize(1339,887)->save(public_path('dist/img/album-kegiatan/'.$filename));

            KegiatanAlbum::create([
                'fid_kegiatan' => $request->input('fid_kegiatan'),
                'caption' => $request->input('caption_filekegiatan'),
                'file_name' => $filename,
                'user_add' => session()->get('nama'),
                'created_at' => Carbon::now()
            ]);
            $output = array("status" => TRUE);
        }
        return response()->json($output);
    }
    public function fotoDestroy(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");
        $data_id = $request->input('idp');
        KegiatanAlbum::where('id', $data_id)->delete();
        return response()->json(['status' => TRUE]);
    }
}
