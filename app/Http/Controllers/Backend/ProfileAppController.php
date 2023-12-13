<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Shortcut;
use App\Http\Controllers\Controller;
use App\Models\ProfileApp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProfileAppController extends Controller
{
    public function index()
    {
        if(!session()->get('login_akses')) { 
            return redirect('/login'); 
        }
        
        $data['header_title'] = 'PROFILE APP';
        
        return view('backend.profile_app', $data);
    }

    public function loadProfileApp()
    {
        $profile_app = ProfileApp::where('id', 1)->first();
        $response = array(
            'status' => TRUE,
            'siteInfo' => $profile_app,
            'url_logoinstansi' => asset('dist/img/logo/'.$profile_app->logo_instansi),
            'url_logopublichead' => asset('dist/img/logo/'.$profile_app->logo_public_head),
            'url_backgroundlogin' => asset('dist/img/banner/'.$profile_app->background_login),
            'url_logobackendhead' => asset('dist/img/logo/'.$profile_app->logo_backend_head),
        );
        return response()->json($response);
    }

    public function profileAppUpdate(Request $request)
    {
		date_default_timezone_set("Asia/Makassar");

        $errors					= [];
        $validator = Validator::make($request->all(), [
            'name_site' => 'required|max:255',
            'name_instansi' => 'required|max:120',
            'subname_instansi' => 'required|max:60',
            'desk_site' => 'required|max:160',
            'keyword_site' => 'required',
            'copyright_site' => 'required|max:255',
            'telp_site' => 'required',
            'email_site' => 'required',
            'wa_site' => 'required',
            'facebook_site' => 'required',
            'instagram_site' => 'required',
            'twitter_site' => 'required',

            'logo_instansi' => 'mimes:png,jpg,jpeg|max:2048',
            'logo_public_head' => 'mimes:png,jpg,jpeg|max:2048',
            'background_login' => 'mimes:png,jpg,jpeg|max:2048',
            'logo_backend_head' => 'mimes:png,jpg,jpeg|max:2048',
        ],[
            'name_site.required' => 'Nama situs tidak boleh kosong.',
            'name_site.max' => 'Nama situs tidak lebih dari 255 karakter.',
            'name_instansi.required' => 'Nama instansi tidak boleh kosong.',
            'name_instansi.max' => 'Nama instansi tidak lebih dari 120 karakter.',
            'subname_instansi.required' => 'Sub nama instansi tidak boleh kosong.',
            'subname_instansi.max' => 'Sub nama instansi tidak lebih dari 60 karakter.',
            'desk_site.required' => 'Deskripsi tidak boleh kosong.',
            'desk_site.max' => 'Deskripsi tidak lebih dari 60 karakter.',
            'keyword_site.required' => 'Keyword tidak boleh kosong.',
            'copyright.required' => 'Copyright tidak boleh kosong.',
            'copyright.max' => 'Copyright tidak lebih dari 255 karakter.',

            'logo_instansi.required' => 'Logo instansi tidak boleh kosong.',
            'logo_instansi.max' => 'Logo instansi tidak lebih dari 2MB.',
            'logo_instansi.mimes' => 'Logo instansi berekstensi jpg jepg png.',

            'logo_public_head.required' => 'Logo public header tidak boleh kosong.',
            'logo_public_head.max' => 'Logo public header tidak lebih dari 2MB.',
            'logo_public_head.mimes' => 'Logo public header berekstensi jpg jepg png.',

            'background_login.required' => 'Background login tidak boleh kosong.',
            'background_login.max' => 'Background login tidak lebih dari 2MB.',
            'background_login.mimes' => 'Background login berekstensi jpg jepg png.',

            'logo_backend_head.required' => 'Logo backend header tidak boleh kosong.',
            'logo_backend_head.max' => 'Logo backend header tidak lebih dari 2MB.',
            'logo_backend_head.mimes' => 'Logo backend header berekstensi jpg jepg png.',

        ]);
    
        if($validator->fails()){
            foreach ($validator->errors()->getMessages() as $item) {
                $errors[] = $item;
            }
            $output = array("status" => FALSE, "pesan_code" => 'format_inputan', "pesan_error" => $errors);
        } else {
            
            if($request->file('logo_instansi')){
                $mainImage = $request->file('logo_instansi');
                $filename = Shortcut::random_strings(20) . '-logoinstansi.' . $mainImage->extension();
                Image::make($mainImage)->resize(512,512)->save(public_path('dist/img/logo/'.$filename));
                ProfileApp::where('id', 1)->update([
                    'logo_instansi' => $filename,
                ]);
            }
            if($request->file('logo_public_head')){
                $mainImage = $request->file('logo_public_head');
                $filename = time() . '-logopublicheader.' . $mainImage->extension();
                Image::make($mainImage)->resize(641,91)->save(public_path('dist/img/logo/'.$filename));
                ProfileApp::where('id', 1)->update([
                    'logo_public_head' => $filename,
                ]);
            }
            if($request->file('background_login')){
                $mainImage = $request->file('background_login');
                $filename = time() . '-bannerlogin.' . $mainImage->extension();
                Image::make($mainImage)->resize(550,450)->save(public_path('dist/img/banner/'.$filename));
                ProfileApp::where('id', 1)->update([
                    'background_login' => $filename,
                ]);
            }
            if($request->file('logo_backend_head')){
                $mainImage = $request->file('logo_backend_head');
                $filename = time() . '-logobackendheader.' . $mainImage->extension();
                Image::make($mainImage)->resize(641,91)->save(public_path('dist/img/logo/'.$filename));
                ProfileApp::where('id', 1)->update([
                    'logo_backend_head' => $filename,
                ]);
            }
            
            ProfileApp::where('id', 1)->update([
                'name_site' => $request->input('name_site'),
                'desk_site' => $request->input('desk_site'),
                'keyword_site' => $request->input('keyword_site'),
                'telp_site' => $request->input('telp_site'),
                'email_site' => $request->input('email_site'),
                'wa_site' => $request->input('wa_site'),
                'facebook_site' => $request->input('facebook_site'),
                'instagram_site' => $request->input('instagram_site'),
                'twitter_site' => $request->input('twitter_site'),
                'copyright_site' => $request->input('copyright_site'),
                'name_instansi' => $request->input('name_instansi'),
                'subname_instansi' => $request->input('subname_instansi'),
                'user_updated' => session()->get('nama'),
                'updated_at' => Carbon::now()
            ]);
            $output = array("status" => TRUE);
        }
        return response()->json($output);
    }
}
