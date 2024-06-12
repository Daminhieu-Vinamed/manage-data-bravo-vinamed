@extends('layout.master')
@section('title', 'welcome')
@section('css')
<link href="{{ asset('assets/css/welcome.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row align-items-center pt-4">
        <div class="col-lg-5 text-center order-lg-1 order-2">
            <div class="text-logo-container">
                <div class="logo-container">
                    <img src="{{ asset('assets/images/logo-vmed-default.png') }}" alt="Logo VMED" class="logo">
                </div>
                <h1 id="welcome-text" class="mb-3">Welcome ERP VMED GROUP, {{Auth::user()->name}}</h1>                   
            </div>
        </div>
        <div class="col-lg-7 order-lg-2 order-1">
            <img src="https://htmlstream.com/preview/front-dashboard-v2.1.1/assets/svg/illustrations/oc-collaboration.svg" alt="Welcome Image" class="img-fluid mb-4" style="max-width: 100%;">
        </div>
    </div>
@endsection