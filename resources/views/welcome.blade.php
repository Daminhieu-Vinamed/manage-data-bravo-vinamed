@extends('layout.master')
@section('title', 'welcome')
@section('css')
<link href="{{ asset('assets/css/welcome.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="text-center">
        <h1 class="display-1 text-primary font-weight-bold">WELCOME</h1>
        <h4 class="display-4 text-primary font-weight-bold">{{Auth::user()->name}}</h4>
    </div>
@endsection