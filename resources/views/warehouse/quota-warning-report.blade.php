@extends('layout.master')
@section('title', 'Nhập liệu tra cứu tồn theo QR')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
@endsection
@section('title-manage')
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ KHO</h1>
    </div>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nhập liệu báo cáo cảnh báo Quota</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('warehouse.data-quota-warning-report') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="startDate" class="form-label small">Từ ngày</label>
                                <input type="date" class="form-control" id="startDate" name="startDate"
                                    value="{{ date('Y-m-d') }}">
                                @error('startDate')
                                    <span class="text-danger small" id="validate-startDate-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="endDate" class="form-label small">Đến ngày</label>
                                <input type="date" class="form-control" id="endDate" name="endDate"
                                    value="{{ date('Y-m-d') }}">
                                @error('endDate')
                                    <span class="text-danger small" id="validate-endDate-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="warehouse" class="form-label small">Khách hàng</label>
                                <input type="text" id="customer" name="customer" class="form-control-select2" />
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            <button class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">Chạy báo cáo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/warehouse/quota-warning-report.js') }}"></script>
@endpush
