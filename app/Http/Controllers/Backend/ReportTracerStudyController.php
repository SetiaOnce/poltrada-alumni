<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Shortcut;
use App\Http\Controllers\Controller;
use App\Models\AkademikMahasiswa;
use App\Models\DataAlumni;
use App\Models\TracerJadwal;
use App\Models\TracerPeserta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use PhpOffice\PhpSpreadsheet\Shared\Trend\Trend;
use Yajra\DataTables\DataTables;

class ReportTracerStudyController extends Controller
{
    public function index()
    {
        if(!session()->get('login_akses')) { 
            return redirect('/login'); 
        }
        return  view('backend.report_tracer_study');
    }
    public function data(Request $request)
    {
        $data = TracerJadwal::orderBy('status', 'DESC')->get();
        return Datatables::of($data)->addIndexColumn()
            ->editColumn('date_awal', function ($row) {
                return date('d-m-Y', strtotime($row->awal));
            })
            ->editColumn('date_akhir', function ($row) {
                return date('d-m-Y', strtotime($row->akhir));
            })
            ->editColumn('jumlah_responden', function ($row) {
                return TracerPeserta::whereJadwalId($row->id)->count();
            })
            ->editColumn('action', function ($row) {
                $btn ='<button type="button" class="btn btn-block btn-sm btn-success font-weight-bold mb-1" data-toggle="tooltip" title="Lihat detail tracer!" onclick="_showPesertaTracer('."'".$row->id."'".');"><i class="bi bi-people"></i> Peserta</button>';
                return $btn;
            })
            ->rawColumns(['date_awal','date_akhir','jumlah_responden', 'action'])
            ->make(true);
    }
    public function detailInfo(Request $request)
    {
        $tracer = TracerJadwal::whereId($request->idp_jadwal)->first(); 
        $output = '
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div class="col-xl-3">
                            <span class="font-weight-bolder">Judul</span>
                        </div>
                        <div class="col-xl-1">
                            <span class="font-weight-bolder"><span class="font-weight-bolder mr-2">: </span></span>
                        </div>
                        <div class="col-xl-8">
                            <p class="font-weight-bold">'.$tracer->judul.'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-3">
                            <span class="font-weight-bolder">Tanggal Awal</span>
                        </div>
                        <div class="col-xl-1">
                            <span class="font-weight-bolder"><span class="font-weight-bolder mr-2">: </span></span>
                        </div>
                        <div class="col-xl-8">
                            <p class="font-weight-bold">'.Shortcut::tanggal($tracer->awal).'</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-3">
                            <span class="font-weight-bolder">Tanggal Akhir</span>
                        </div>
                        <div class="col-xl-1">
                            <span class="font-weight-bolder"><span class="font-weight-bolder mr-2">: </span></span>
                        </div>
                        <div class="col-xl-8">
                            <p class="font-weight-bold">'.Shortcut::tanggal($tracer->awal).'</p>
                        </div>
                    </div>
                </div>
            </div>
        ';
        return response()->json(['status' => TRUE, 'output' => $output]);
    }
    public function pesertaTracer(Request $request)
    {
        $data = TracerPeserta::orderBy('nama_lengkap', 'ASC')->whereJadwalId($request->idp_jadwal)->get();
        return Datatables::of($data)->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }
}
