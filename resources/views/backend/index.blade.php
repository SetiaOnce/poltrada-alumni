@extends('backend.layouts', ['activeMenu' => 'DASHBOARD', 'activeSubMenu' => '', 'title' => 'Dahsboard'])
@section('content')
<div class="container">
    <!--End::Begin-->
    <div class="row" id="firstWidget"></div>
    <!--End::Row-->
    <!--End::Begin-->
    <div class="row" id="userInfoWidget"></div>
    <!--End::Row-->
</div>
@section('js')
<script type="text/javascript" src="{{ asset('script/backend/dashboard.js') }}"></script>
@stop
@endsection
