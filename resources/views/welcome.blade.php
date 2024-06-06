@extends('layout.master')
@section('title', 'welcome')
@section('css')
<link href="{{ asset('assets/css/welcome.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="text-center">
        <p>WELCOME<br>
         <small>{{Auth::user()->name}}</small>
        </p>
        <span class="circle big"></span>
        <span class="circle med"></span>
        <span class="circle small"></span>
    </section>
@endsection