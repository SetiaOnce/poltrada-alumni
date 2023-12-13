<?php

namespace App\Http\Controllers\Alumni;

use App\Models\ProfileApp;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemAlumniController extends Controller
{
    public function loadProfile()
    {
        $response = array(
            'status' => TRUE,
            'nama' => Auth::user()->nama,
            'foto' => 'https://sitaruna.poltradabali.ac.id/storage/taruna/'.Auth::user()->foto.'',
            'level' => 'ALUMNI',
            'email' => Auth::user()->email,
        );
        $output_nav ='
            <div class="d-flex flex-column text-right pr-sm-3">
                <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-sm-inline">'.$response['nama'].'</span>
                <span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline">'.$response['email'].'</span>
            </div>
            <span class="symbol symbol-35">
                <div class="symbol-label" style="background-image: url('.$response['foto'].')"></div>
                <i class="symbol-badge bg-success"></i>
            </span>
        ';
        return response()->json(['outputNav' => $output_nav]);
    }
    public function loadProfileApp()
    {
        $profile_app = ProfileApp::where('id', 1)->first();
        $response = array(
            'status' => TRUE,
            'copyright' => $profile_app->copyright_site,
            'url_logoinstansi' => asset('dist/img/logo/'.$profile_app->logo_instansi),
            'url_logobackendhead' => asset('dist/img/logo/'.$profile_app->logo_backend_head),
        );
        return response()->json($response);
    }
    protected function upload_imgeditor(Request $request) {
        $errors					= [];
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:png,jpg,jpeg|max:1024',
        ],[
            'image.max' => 'File banner tidak lebih dari 1MB.',
            'image.mimes' => 'File banner berekstensi jpg jepg png.',
        ]);
        if($validator->fails()){
            foreach ($validator->errors()->getMessages() as $item) {
                $errors[] = $item;
            }
            $output = array("status" => FALSE, "pesan_code" => 'format_inputan', "pesan_error" => $errors);
        } else {
            $mainImage = $request->file('image');
            $filename = time() . 'custom-image.' . $mainImage->extension();
            Image::make($mainImage)->save(public_path('dist/img/summernote-img/'.$filename));
            $output = array(
                "status" => TRUE,
                "url_img" => url('dist/img/summernote-img/'.$filename),
            );
        }
        return response()->json($output);
    }
}
