@extends('layout.master')
@section('title', 'Chúc mừng sinh nhật')
@section('css')
    <link href="{{ asset('assets/css/event/happy-birthday.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row d-flex align-items-center justify-content-center">
        <h3 class="wish position-absolute text-center">Happy birthday {{ $name }}</h3>
        <canvas class="confetti w-100 d-block no-select" id="canvas"></canvas>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/event/happy-birthday.js') }}"></script>
@endpush