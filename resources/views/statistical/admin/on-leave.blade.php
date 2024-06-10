@extends('layout.master')
@section('title', 'Chấm công')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/calendar/fullcalendar.css') }}" />
@endsection
@section('title-manage')
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">THỐNG KÊ NGHỈ PHÉP</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">Biểu đồ nghỉ phép</h6>
        </div>
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/calendar/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/calendar/locale.js') }}"></script>
    <script src="{{ asset('assets/vendor/calendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/js/statistical/admin/on-leave.js') }}"></script>
@endpush
