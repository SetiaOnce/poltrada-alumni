<?php

namespace App\Http\Controllers;

use App\Models\DataAlumni;
use App\Models\ProfileApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CommonController extends Controller
{
    public function loadProfile()
    {
        $response = array(
            'status' => TRUE,
            'nama' => session()->get('nama'),
            'foto' => session()->get('foto'),
            'level' => session()->get('level'),
            'email' => session()->get('email'),
        );
        
        $output_nav ='
        <div class="d-flex flex-column text-right pr-sm-3">
            <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-sm-inline">'.$response['nama'].'</span>
            <span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline">'.$response['level'].'</span>
        </div>
        <span class="symbol symbol-35">
            <div class="symbol-label" style="background-image: url('.$response['foto'].')"></div>
            <i class="symbol-badge bg-success"></i>
        </span>
        ';

        $sideOutput = '
        <div class="symbol symbol-light-dark symbolThumbSideRight symbol-100 mr-5">
        <div class="symbol-label" style="background-image:url('.$response['foto'].')"></div>
        </div>
        <div class="d-flex flex-column userMailSideRight">
            <a href="javascript:void(0);" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">'.$response['nama'].'</a>
            <div class="text-muted mt-1">'.$response['level'].'</div>
            <div class="navi mt-2">
                <a href="javascript:void(0);" class="navi-item">
                    <span class="navi-link p-0 pb-2">
                        <span class="navi-icon mr-1">
                            <span class="svg-icon svg-icon-lg svg-icon-primary">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo7/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                        <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="navi-text text-muted text-hover-primary">'.$response['email'].'</span>
                    </span>
                </a>
            </div>
        </div>
        ';
        
        return response()->json(['outputNav' => $output_nav, 'sideOutput' => $sideOutput]);
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
    public function loaduserProfile()
    {
        $response = array(
            'nama' => session()->get('nama'),
            'foto' => session()->get('foto'),
            'level' => session()->get('level'),
            'email' => session()->get('email'),
            'alamat' => session()->get('alamat'),
            'nik' => session()->get('nik'),
            'unit_kerja' => session()->get('unit_kerja'),
        );
        return response()->json($response);
    }
    public function widgetCount()
    {
        $countJumlahAlumn = DataAlumni::all()->count();
        $countAlumniWanita = DataAlumni::where('jenis_kelamin', 'WANITA')->count();
        $countAlumniLakiLaki = DataAlumni::where('jenis_kelamin', 'LAKI-LAKI')->count();

        $response = array(
            'jmlh_alumni' => $countJumlahAlumn,
            'jmlh_alumni_perempuan' => $countAlumniWanita,
            'jmlh_alumni_laki_laki' => $countAlumniLakiLaki,
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
