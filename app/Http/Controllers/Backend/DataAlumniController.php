<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Shortcut;
use App\Http\Controllers\Controller;
use App\Models\AkademikMahasiswa;
use App\Models\DataAlumni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class DataAlumniController extends Controller
{
    public function index()
    {
        if(!session()->get('login_akses')) { 
            return redirect('/login'); 
        }
        return  view('backend.data_alumni');
    }
    public function data(Request $request)
    {
        $query = DataAlumni::orderBy('nama', 'ASC')->whereNot('provinsi_id', 0);
        if($request->input('tahun')){
            $query = $query->where('angkatan', $request->input('tahun'));
        }if($request->input('prodi')){
            $query = $query->where('kode_prodi', $request->input('prodi'));
        }if($request->input('prodi') AND $request->input('tahun')){
            $query = $query->where('kode_prodi', $request->input('prodi'))->where('angkatan', $request->input('tahun'));
        }
        $data = $query->get();
        return Datatables::of($data)->addIndexColumn()
            ->editColumn('foto', function ($row) {
                $fotoTaruna = 'https://sitaruna.poltradabali.ac.id/storage/taruna/'.$row->foto.'';
                $fileCustom = '<a class="d-block overlay w-100 image-popup" href="'.$fotoTaruna.'" title="'.$row->foto.'">
                    <img src="'.$fotoTaruna.'" class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover rounded w-100" alt="'.$row->foto.'" />
                    <div class="overlay-layer card-rounded ">
                        <span class="badge badge-dark"><i class="las la-search fs-3 text-light"></i></span>
                    </div>    
                </a>';
                return $fileCustom;
            })
            ->editColumn('provinsi', function ($row) {
                return $row->provinsi->provinsi;
            })
            ->editColumn('tanggal_lahir', function ($row) {
                return date('d-m-Y', strtotime($row->tanggal_lahir));
            })
            ->editColumn('instansi', function ($row) {
                $output = $row->instansi_kerja;
                if($row->instansi_kerja == null){
                    $output = '-';
                }
                return $output;
            })
            ->editColumn('prodi', function ($row) {
                $output =''.$row->prodi->nama_jenjang.' - '.$row->prodi->nama_prodi.'';
                return $output;
            })
            ->rawColumns(['foto','prodi','tanggal_lahir','provinsi','instansi'])
            ->make(true);
    }
    public function sincronisasi(Request $request)
    {
        $tahun = $request->input('tahunAngkatan');
        try{  
            $dtmahasiswa = AkademikMahasiswa::where('angkatan', $tahun)->where('status', 4)->get();
            foreach($dtmahasiswa as $mahasiswa){
                // check data mahasiswa into table alumni
                $checkMahasiswa = DataAlumni::where('nim', $mahasiswa->nim)->first();
                if (empty($checkMahasiswa)) {
                    DataAlumni::create([
                        'kode_prodi' => $mahasiswa->kode_prodi,
                        'nama' => $mahasiswa->nama,
                        'tempat_lahir' => $mahasiswa->tempat_lahir,
                        'tanggal_lahir' => $mahasiswa->tanggal_lahir,
                        'negara_id' => $mahasiswa->negara_id,
                        'provinsi_id' => $mahasiswa->provinsi_id,
                        'kabupaten_id' => $mahasiswa->kabupaten_id,
                        'kecamatan_id' => $mahasiswa->kecamatan_id,
                        'kelurahan_id' => $mahasiswa->kelurahan_id,
                        'alamat' => $mahasiswa->alamat,
                        'telp' => $mahasiswa->telp,
                        'agama' => $mahasiswa->agama,
                        'jenis_kelamin' => $mahasiswa->jenis_kelamin,
                        'email' => $mahasiswa->email,
                        'password' => Hash::make($mahasiswa->tanggal_lahir),
                        'nim' => $mahasiswa->nim,
                        'nik' => $mahasiswa->nik,
                        'nisn' => $mahasiswa->nisn,
                        'npwp' => $mahasiswa->npwp,
                        'foto' => $mahasiswa->foto,
                        'koor_lat' => $mahasiswa->koor_lat,
                        'koor_long' => $mahasiswa->koor_long,
                        'angkatan' => $mahasiswa->angkatan,
                        'uuid' => $mahasiswa->uuid,
                    ]);
                }
            }
            $output = array("status" => TRUE);
        }catch(\GuzzleHttp\Exception\ConnectException $e){
            $output = array("status" => FALSE);
        } 
        return response()->json($output);
    }
}
