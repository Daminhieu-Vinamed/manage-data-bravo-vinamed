@extends('layout.master')
@section('title', 'Đề nghị thanh toán')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/calendar/fullcalendar.css') }}" />
@endsection
@section('title-manage')
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ CHẤM CÔNG</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lịch chấm công</h6>
            <button class="btn btn-primary shadow-sm btn-circle" data-toggle="modal" data-target="#timekeepingModal"
                title="Tạo mới tài khoản"><i class="fas fa-clock"></i></button>
        </div>
        <div class="card-body">
            <div class="response"></div>
            <div id='calendar'></div>
        </div>
    </div>
    <div class="modal fade" id="timekeepingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chấm công cho ngày hôm nay</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-around">
                        <div class="text-center col-4">
                            <label for="hour" class="h3 text-primary font-weight-bold">GIỜ</label>
                            <div id="hour" class="bg-primary shadow-sm rounded-circle w-50 mx-auto">
                                <h4 class="text-white py-3 run-hour">00</h4>
                            </div>
                        </div>
                        <div class="text-center col-4">
                            <label for="minute" class="h3 text-primary font-weight-bold">PHÚT</label>
                            <div id="minute" class="bg-primary shadow-sm rounded-circle w-50 mx-auto">
                                <h4 class="text-white py-3 run-minute">00</h4>
                            </div>
                        </div>
                        <div class="text-center col-4">
                            <label for="second" class="h3 text-primary font-weight-bold">GIÂY</label>
                            <div id="second" class="bg-primary shadow-sm rounded-circle w-50 mx-auto">
                                <h4 class="text-white py-3 run-second">00</h4>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column bd-highlight mt-4 mx-4">
                        <div class="bd-highlight">
                            <h5 class="text-primary font-weight-bold pb-2 date-today"></h5>
                        </div>
                        <div class="bd-highlight d-sm-flex align-items-center justify-content-between">
                            <p class="font-weight-bold">
                                <b class="text-primary">Thời gian vào:</b> 
                                <b id="standard-clock-in">{{$StandardClockIn}}</b>
                            </p>
                            <p class="font-weight-bold">
                                <b class="text-primary">Thời gian ra:</b> 
                                <b id="standard-clock-out">{{$StandardClockOut}}</b>
                            </p>
                        </div>
                        <div class="bd-highlight d-sm-flex align-items-center justify-content-between">
                            <p class="font-weight-bold">
                                <b class="text-primary">Thời gian vào:</b> 
                                <b id="timekeeping-in">{{ isset($timekeepingToday) ? date('H:i:s', strtotime($timekeepingToday->start)) : config('constants.timekeeping.default') }}</b>
                            </p>
                            <p class="font-weight-bold">
                                <b class="text-primary">Thời gian ra:</b> 
                                <b id="timekeeping-out">{{ isset($timekeepingToday) ? date('H:i:s', strtotime($timekeepingToday->end)) : config('constants.timekeeping.default') }}</b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if (isset($timekeepingToday))
                        <button class="btn btn-danger shadow-sm clock_out" disabled>Kết thúc</button>
                    @else
                        <button class="btn btn-primary shadow-sm" id="clock_in">Chấm công</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/calendar/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/calendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/js/timekeeping/func.js') }}"></script>
    <script src="{{ asset('assets/js/timekeeping/list.js') }}"></script>
@endpush
