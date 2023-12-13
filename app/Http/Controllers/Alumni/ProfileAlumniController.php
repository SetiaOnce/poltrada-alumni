<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\DataAlumni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileAlumniController extends Controller
{
    public function index()
    {
        return  view('alumni.profile_alumni');
    }
    public function data(Request $request)
    {
        $nim = Auth::user()->nim;
        $alumni = DataAlumni::where('nim', $nim)->first();
        $response = array(
            'status' => TRUE,
            'row' => $alumni,
            'tanggal_lahir' => Carbon::createFromFormat('Y-m-d', $alumni->tanggal_lahir)->format('d/m/Y'),
        );
        return response()->json($response);
    }
    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");
        $errors					= [];
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:150',
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required',
            'alamat' => 'required|max:200',
            'email' => 'required',
            'telp' => 'required|max:15',
            'tanggal_lahir' => 'required',
            'instansi_kerja' => 'required|max:255',
        ],[
            'nama.required' => 'Nama masih kosong...',
            'nama.max' => 'Nama tidak lebih dari 150 karakter.',
            'provinsi_id.required' => 'Provinsi masih kosong...',
            'kabupaten_id.required' => 'Kabupaten masih kosong...',
            'alamat.required' => 'Alamat masih kosong...',
            'alamat.max' => 'Alamat tidak lebih dari 150 karakter.',
            'email.required' => 'Email masih kosong...',
            'telp.required' => 'No telepon/whatsapp masih kosong...',
            'telp.max' => 'No telepon/whatsapp tidak lebih dari 15 digit.',
            'tanggal_lahir.required' => 'Tanggal lahir masih kosong...',
            'instansi_kerja.required' => 'Instansi/tempat kerja masih kosong...',
            'instansi_kerja.max' => 'Instansi/tempat kerja tidak lebih dari 255 karakter.',
        ]);
    
        if($validator->fails()){
            foreach ($validator->errors()->getMessages() as $item) {
                $errors[] = $item;
            }
            $output = array("status" => FALSE, "pesan_code" => 'format_inputan', "pesan_error" => $errors);
        } else {
            // parse date
            $tanggal_lahir=Carbon::createFromFormat('d/m/Y', $request->input('tanggal_lahir'))->format('Y-m-d'); 
            DataAlumni::where('nim', $request->input('nim'))->update([
                'nama' => $request->input('nama'),
                'provinsi_id' => $request->input('provinsi_id'),
                'kabupaten_id' => $request->input('kabupaten_id'),
                'alamat' => $request->input('alamat'),
                'email' => $request->input('email'),
                'telp' => $request->input('telp'),
                'tanggal_lahir' => $tanggal_lahir,
                'password' => Hash::make($tanggal_lahir),
                'instansi_kerja' => $request->input('instansi_kerja'),
            ]);
            $output = array("status" => TRUE);
        }
        return response()->json($output);
    }
}
