<?php

namespace App\Http\Controllers;

use App\Helpers\Shortcut;
use App\Models\AkademikKelasDetail;
use App\Models\AkademikProdi;
use App\Models\BannerHome;
use App\Models\DataAlumni;
use App\Models\GroupProvinsi;
use App\Models\Kegiatan;
use App\Models\KegiatanAlbum;
use App\Models\ProfileApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class FrontendController extends Controller
{
    // ==>>FOR PAGE RIDIRECT<<==//
    public function index()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        $data['dtkegiatan'] = Kegiatan::where('status', 1)->orderBy('id', 'DESC')->paginate(8);
        return view('frontend.index', $data);
    }
    public function detailKegiatan($id, $slug)
    {
        Kegiatan::where('id', $id)->increment('views');
        $data['kegiatan'] = Kegiatan::where('id', $id)->first();
        $data['dtkeyword'] = explode(',',  $data['kegiatan']['keyword_tag']);
        $data['dtKegiatanAlbum'] = KegiatanAlbum::where('fid_kegiatan', $data['kegiatan']['id'])->get();
        return view('frontend.detail_kegiatan', $data);
    }
    // ==>>FOR AJAX REQUEST<<==//
    public function loadSystemInfo()
    {
        $banner = BannerHome::where('id', 1)->first();
        $profile_app = ProfileApp::where('id', 1)->first();
        $url_banner = asset('dist/img/banner/'.$banner->file_banner);
        
        $response = array(
            'status' => TRUE,
            'url_banner' => $url_banner,
            'banner_text' => $banner->description,
            'copyright' => $profile_app->copyright_site,
            'url_logo_public' => asset('dist/img/logo/'.$profile_app->logo_public_head),
        );
        return response()->json($response);
    }
    public function dataAlumni(Request $request)
    {
        $data = DataAlumni::where('kode_prodi', $request->input('kode_prodi'))->orderBy('nama', 'ASC')->get();

        return Datatables::of($data)->addIndexColumn()
            ->editColumn('notar', function ($row) {
                return substr($row->nim, 0, 2).'XXXX';
            })
            ->editColumn('nama', function ($row) {
                return $row->nama;
            })
            ->editColumn('angkatan', function ($row) {
                return $row->angkatan;
            })
            ->editColumn('jurusan', function ($row) {
                return $row->prodi->nama_jenjang.' - '.$row->prodi->nama_prodi;
            })
            ->editColumn('instansi', function ($row) {
                $instansi_kerja = $row->instansi_kerja;
                if($row->instansi_kerja == null){
                    $instansi_kerja = '-';
                }
                return $instansi_kerja;
            })
            ->rawColumns(['notar', 'nama', 'angkatan', 'jurusan', 'instansi'])
            ->make(true);
    }
    public function pieProgramStudi(Request $request)
    {
        $dtProdi = AkademikProdi::orderBy('nama_prodi', 'ASC')->get();
        foreach ($dtProdi as $prodi) {
            $jmlh = DataAlumni::where('kode_prodi', $prodi->kode_prodi)->count();
            $output[] = [
                'name' => $prodi->nama_prodi, 
                'y' => $jmlh, 
            ];
        }
        $response = array(
            'status' => TRUE,
            'output' => $output,
        );
        return response()->json($response);
    }
    public function modalALumni(Request $request)
    {
        $data = DataAlumni::where('provinsi_id', $request->input('fid_provinsi'))->orderBy('nama', 'ASC')->get();

        return Datatables::of($data)->addIndexColumn()
            ->editColumn('notar', function ($row) {
                return substr($row->nim, 0, 2).'XXXX';
            })
            ->editColumn('nama', function ($row) {
                return $row->nama;
            })
            ->editColumn('angkatan', function ($row) {
                return $row->angkatan;
            })
            ->editColumn('jurusan', function ($row) {
                return $row->prodi->nama_jenjang.' - '.$row->prodi->nama_prodi;
            })
            ->editColumn('instansi', function ($row) {
                $instansi_kerja = $row->instansi_kerja;
                if($row->instansi_kerja == null){
                    $instansi_kerja = '-';
                }
                return $instansi_kerja;
            })
            ->rawColumns(['notar', 'nama', 'angkatan', 'jurusan', 'instansi'])
            ->make(true);
    }
    public function mapsAlumni(Request $request)
    {
        $dtProvinsi = GroupProvinsi::all();
        foreach($dtProvinsi as $province){
            // banyak alumni dalam lokasi
            $countAlumni = DataAlumni::where('provinsi_id', $province->id)->count();
            // menyeleksi data kordinat pada meta data kordinat
            preg_match_all('/[0-9\-.]+/', $province->meta, $matches);
            $arrayMaps[] = [
                'id' => $province->id,
                'province' => $province->provinsi,
                'alumni' => $countAlumni,
                'lat' => $matches[0][0],
                'lng' => $matches[0][1],
            ];
        }
        $response = array(
            'status' => TRUE,
            'arrayMaps' => $arrayMaps,
        );
        return response()->json($response);
    }
    public function cekDataku(Request $request)
    {
        $nim = $request->input('notar');
        $alumni = DataAlumni::where('nim', $nim)->first();
        if(empty($alumni)){
            $output = '';
        }else{
            $instansi_kerja = $alumni->instansi_kerja;
            if($alumni->instansi_kerja == null){
                $instansi_kerja = '-';
            }
            $fotoAlumni = "https://sitaruna.poltradabali.ac.id/storage/taruna/".$alumni->foto;
            $output = '
                <div class="pt-3 pb-3 pl-10 pr-2 border rounded border-dashed">
                    <div class="row justify-content-center">
                        <div class="col-xl-2">
                            <span class="font-weight-bolder">No.Taruna</span>
                        </div>
                        <div class="col-xl-10">
                            <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->nim.'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-2">
                            <span class="font-weight-bolder">Nama Lengkap</span>
                        </div>
                        <div class="col-xl-10">
                            <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->nama.'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-2">
                            <span class="font-weight-bolder">Alamat</span>
                        </div>
                        <div class="col-xl-10">
                            <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->alamat.'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-2">
                            <span class="font-weight-bolder">Kab.Kota</span>
                        </div>
                        <div class="col-xl-10">
                            <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->kabupaten->kabupaten.'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-2">
                            <span class="font-weight-bolder">Jenis Kelamin</span>
                        </div>
                        <div class="col-xl-10">
                            <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->jenis_kelamin.'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-2">
                            <span class="font-weight-bolder">Email</span>
                        </div>
                        <div class="col-xl-10">
                            <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->email.'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-2">
                            <span class="font-weight-bolder">Telepon</span>
                        </div>
                        <div class="col-xl-10">
                            <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->telp.'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-2">
                            <span class="font-weight-bolder">Whatsapp</span>
                        </div>
                        <div class="col-xl-10">
                            <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->telp.'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-2">
                            <span class="font-weight-bolder">Angkatan</span>
                        </div>
                        <div class="col-xl-10">
                            <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->angkatan.'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-2">
                            <span class="font-weight-bolder">Program Studi</span>
                        </div>
                        <div class="col-xl-10">
                            <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->prodi->nama_jenjang.' - '.$alumni->prodi->nama_prodi.'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-2">
                            <span class="font-weight-bolder">Instansi/Tempat Kerja</span>
                        </div>
                        <div class="col-xl-10">
                            <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$instansi_kerja.'</p>
                        </div>
                    </div>
                </div>
            ';
        }
        return response()->json($output);
    }
    public function loadMoreKegiatan(Request $request)
    {
        $data['dtkegiatan'] = Kegiatan::where('status', 1)->orderBy('id', 'DESC')->paginate(4);
        return view('frontend.paginate.kegiatan', $data);

    }
    public function otherKegiatan(Request $request)
    {
        $idp = $request->input('idp_kegiatan');
        $query = Kegiatan::whereNotIn('id', [$idp])->orderBy('id', 'DESC')->where('status', 1)->limit(4)->get();
        $output = '';
        $output .= '';
        foreach($query as $row)
        {
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
            $output .='
                <div class="col-lg-12 mb-6">
                    <div class="d-flex align-items-center">
                        <!--begin::Symbol-->
                        <a href="'. url('/baca/'.$row->id.'/'.$row->slug.'').'" class="symbol symbol-70 flex-shrink-0 mr-5">
                            <img src="'.$url_file.'" title="'.$file_image.'" alt="'.$file_image.'">
                        </a>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1">
                            <a href="'. url('/baca/'.$row->id.'/'.$row->slug.'').'" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">'.Str::limit($row->judul, 50).'</a>
                            <span class="text-muted font-weight-bold"><i class="bi bi-alarm me-1 align-middle"></i> 
                            '.Shortcut::tanggalLower($row->tgl_post).' '.Shortcut::TimeStamp($row->created_at).'
                            </span>
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            ';
        }
        $output .= '';
        return response()->json($output);
    }
    public function populerKegiatan(Request $request)
    {
        $idp = $request->input('idp_kegiatan');
        $query = Kegiatan::whereNotIn('id', [$idp])->orderBy('views', 'DESC')->where('status', 1)->limit(4)->get();
        $output = '';
        $output .= '';
        foreach($query as $row)
        {
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
            $output .='
                <div class="col-lg-12 mb-6">
                    <div class="d-flex align-items-center">
                        <!--begin::Symbol-->
                        <a href="'. url('/baca/'.$row->id.'/'.$row->slug.'').'" class="symbol symbol-70 flex-shrink-0 mr-5">
                            <img src="'.$url_file.'" title="'.$file_image.'" alt="'.$file_image.'">
                        </a>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1">
                            <a href="'. url('/baca/'.$row->id.'/'.$row->slug.'').'" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">'.Str::limit($row->judul, 50).'</a>
                            <span class="text-muted font-weight-bold"><i class="bi bi-alarm me-1 align-middle"></i> 
                            '.Shortcut::tanggalLower($row->tgl_post).' '.Shortcut::TimeStamp($row->created_at).'
                            </span>
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
            ';
        }
        $output .= '';
        return response()->json($output);
    }
}
