@extends('alumni.layouts', ['activeMenu' => 'DASHBOARD', 'activeSubMenu' => '', 'title' => 'Dahsboard'])
@section('content')

<div class="container">
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Card Data Asesor-->
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            <span class="svg-icon svg-icon-dark svg-icon-2x">
                                <i class="bi bi-book-half icon-1x align-middle text-dark"></i>
                            </span>
                            INFORMASI TRACER STUDY
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row m-0" id="sectionTracerStudy">
                        
                    </div>
                </div>
            </div>
            <!--end::Card Data Asesor-->
        </div>
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mt-6" id="sectionProfile" style="display: none;">
        <div class="col-xl-12">
            <!--begin::Card Data Asesor-->
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            <span class="svg-icon svg-icon-dark svg-icon-2x">
                               <i class="mdi mdi-account icon-2x align-middle text-dark"></i>
                            </span>
                            PROFILE
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container pt-3 pb-3 pl-10 pr-2 border rounded border-dashed" id="contentProfile"></div>
                </div>
            </div>
            <!--end::Card Data Asesor-->
        </div>
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mt-6">
        <div class="col-xl-12">
            <!--begin::Card Data Asesor-->
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            <span class="svg-icon svg-icon-dark svg-icon-2x">
                               <i class="mdi mdi-card-account-details icon-2x align-middle text-dark"></i>
                            </span>
                            Kartu Hasil Study
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dt-khs" class="table table-hover table-bordered table-head-custom dtr-inline w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="align-middle">SEMESTER</th>
                                    <th class="align-middle">KODE</th>
                                    <th class="align-middle">NAMA MATA KULIAH</th>
                                    <th class="align-middle">SKS</th>
                                    <th class="align-middle">NILAI</th>
                                    <th class="align-middle">GRADE</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <!--end::Card Data Asesor-->
        </div>
    </div>
    <!--end::Row-->
</div>

@section('js')
<script type="text/javascript" src="{{ asset('script/alumni/dashboard.js') }}"></script>
@stop
@endsection
