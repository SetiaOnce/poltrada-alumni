<?php

namespace App\Http\Controllers\Alumni;

use App\Helpers\Shortcut;
use App\Http\Controllers\Controller;
use App\Models\AkademikPenerbitTranskip;
use App\Models\AkademikSkalaNilai;
use App\Models\DataAlumni;
use App\Models\TracerJadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DashboardAlumniController extends Controller
{
    public function loadProfile()
    {
        $nim = Auth::user()->nim;
        $alumni = DataAlumni::where('nim', $nim)->first();
        $instansi_kerja = $alumni->instansi_kerja;
        if($alumni->instansi_kerja == null){
            $instansi_kerja = '-';
        }
        $fotoAlumni = "https://sitaruna.poltradabali.ac.id/storage/taruna/".$alumni->foto;
        $output = '
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a class="d-block overlay w-100 image-popup" href="'.$fotoAlumni.'" title="'.$alumni->foto.'">
                    <img src="'.$fotoAlumni.'" class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover rounded w-100" alt="'.$alumni->foto.'" /> 
                </a>
            </div>
            <div class="col-md-8">
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">No.Taruna</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->nim.'</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">Nama Lengkap</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->nama.'</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">Alamat</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->alamat.'</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">Kab.Kota</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->kabupaten->kabupaten.'</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">Jenis Kelamin</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->jenis_kelamin.'</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">Email</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->email.'</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">Telepon</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->telp.'</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">Whatsapp</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->telp.'</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">Angkatan</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->angkatan.'</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">Program Studi</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$alumni->prodi->nama_jenjang.' - '.$alumni->prodi->nama_prodi.'</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">Tanggal Lahir</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.Shortcut::tanggalLower($alumni->tanggal_lahir).'</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-4">
                        <span class="font-weight-bolder">Instansi/Tempat Kerja</span>
                    </div>
                    <div class="col-xl-8">
                        <p class="font-weight-bold"><span class="font-weight-bolder mr-2">: </span>'.$instansi_kerja.'</p>
                    </div>
                </div>
            </div>
        </div>
        ';
        return response()->json($output);
    }
    public function loadTracerStudy()
    {
        $jadwalTracer = TracerJadwal::orderBy('id', 'DESC')->whereStatus(1)->first(); 
        if(!empty($jadwalTracer)){
            $output = '
                <a href="https://tracerstudy.poltradabali.ac.id/isi/'.$jadwalTracer->uuid.'" target="_blank">
                    <div class="col bg-light-success px-6 py-8 rounded-xl mr-7">
                        <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                            <i class="bi bi-alarm font-size-h4 text-warning align-center mr-3"></i> <span class="text-warning font-size-h5">'.Shortcut::tanggal($jadwalTracer->awal).' - '.Shortcut::tanggal($jadwalTracer->akhir).'</span>
                        </span> 
                        <span class="text-dark font-weight-bold font-size-h6 mt-2">
                            '.$jadwalTracer->judul.'
                        </span>
                    </div>
                </a>
            ';
        }else{
            $output = '
                
            ';
        }
        return response()->json($output);
    }
    public function kartuHasilStudy(Request $request)
    {
        $data = AkademikPenerbitTranskip::where('notar', Auth::user()->nim)
        ->groupBy([
            'semester',
            'kode_matakuliah',
        ])
        ->orderBy('semester', 'ASC')
        ->get();
        return Datatables::of($data)->addIndexColumn()
            ->editColumn('grade', function ($row) {
                $result = DB::select("
                    SELECT akademik_skala_nilai.grade, akademik_skala_nilai.minimal, akademik_skala_nilai.maksimal
                    FROM akademik_skala_nilai
                    INNER JOIN akademik_kurikulum ON akademik_skala_nilai.kurikulum_id = akademik_kurikulum.id
                    WHERE :nilai_total BETWEEN akademik_skala_nilai.minimal AND akademik_skala_nilai.maksimal 
                    AND akademik_kurikulum.id = :kurikulum_id
                    LIMIT 1;
                ", ['nilai_total' => $row->nilai_total, 'kurikulum_id' => $row->kurikulum_id]);
            
                $result = collect($result)->first();
                return $result->grade; 
            })
            ->rawColumns(['grade'])
            ->make(true);
    }
}
