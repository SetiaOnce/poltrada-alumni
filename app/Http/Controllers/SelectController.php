<?php

namespace App\Http\Controllers;

use App\Models\AkademikProdi;
use App\Models\GroupKabupaten;
use App\Models\GroupProvinsi;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function loadProdi(Request $request)
    {
        $query = AkademikProdi::orderBy('nama_prodi', 'ASC')->get();
        return response()->json($query);
    }
    public function loadProvinsi(Request $request)
    {
        $query = GroupProvinsi::all();
        return response()->json($query);
    }
    public function loadKabupaten(Request $request)
    {
        if($request->provinsi_id){
            $query = GroupKabupaten::whereProvinsiId($request->provinsi_id)->get();
        }else{
            $query = GroupKabupaten::all();
        }
        return response()->json($query);
    }
}
