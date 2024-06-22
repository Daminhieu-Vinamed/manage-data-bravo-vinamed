@extends('layout.master')
@section('title', 'Chấm công')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/calendar/fullcalendar.css') }}" />
@endsection
@section('title-manage')
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ CÔNG</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lịch công</h6>
            <button class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#timekeepingModal"
                title="Chấm công">Chấm công</button>
        </div>
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
    @include('timekeeping.popup')
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/calendar/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/calendar/locale.js') }}"></script>
    <script src="{{ asset('assets/vendor/calendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/js/timekeeping/func.js') }}"></script>
    <script src="{{ asset('assets/js/timekeeping/list.js') }}"></script>
    <script src="{{ asset('assets/js/timekeeping/realtime.js') }}"></script>
    <script src="{{ asset('assets/js/timekeeping/supplements-and-leave.js') }}"></script>
@endpush
