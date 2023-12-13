<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\DataAlumni;
use App\Models\ProfileApp;
use App\Models\SsoAplikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class LoginAlumniController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/app_alumni/dashboard');
        }
        return view('login.login_alumni');
    }

    public function login(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $errors					= [];
        $validator = Validator::make($request->all(), [
            'notar' => 'required',
            'tgl_lahir' => 'required',
        ],[
            'notar.required' => 'Notar masih kosong...',
            'tgl_lahir.required' => 'Tanggal lahir masih kosong...',
        ]);

        if($validator->fails()){
            foreach ($validator->errors()->getMessages() as $item) {
                $errors[] = $item;
            }
            $output = array("status" => FALSE, "pesan_code" => 'format_inputan', "pesan_error" => $errors);
        } else {
            try{  
                // parse date
                $tanggal_lahir=Carbon::createFromFormat('d/m/Y', $request->input('tgl_lahir'))->format('Y-m-d'); 
                $alumni = DataAlumni::whereNim($request->input('notar'))->first();
                if(!empty($alumni)){
                    if($alumni->tanggal_lahir == $tanggal_lahir){
                        Auth::login($alumni);
                        $output = array("status" => TRUE);	
                    }else{
                        $output = array("notFound" => TRUE);		
                    }
                }else{
                    $output = array("notFound" => TRUE);		
                }
            }catch(\GuzzleHttp\Exception\ConnectException $e){
                $output = array("status" => FALSE);
            } 

        }
        return response()->json($output);
    }
    public function loadLoginInfo()
    {
        $getRow = ProfileApp::where('id', 1)->first();
        $response = array(
            'row' => $getRow,
            'url_logologinhead' => asset('dist/img/logo/'.$getRow->logo_public_head),
        );
        return response()->json($response);
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login_alumni');
    }
}
