@extends('layout.master')
@section('title', 'Danh sách tồn theo QR')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.responsive.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
@endsection
@section('title-manage')
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ KHO</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">Báo cáo cảnh báo Quota</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-sm-flex align-items-center justify-content-between" id="filterWarehouse">
                    <div class="lengthInTable"></div>
                    <div class="searchInTable"></div>
                </div>
                <table class="table table-bordered" id="tableWarehouse" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Số</th>
                            <th>Mã HĐ</th>
                            <th>Ngày tạo HĐ</th>
                            <th>Ngày ký HĐ</th>
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Vùng miền</th>
                            <th>Mã hàng</th>
                            <th>Tên hàng hóa dịch vụ</th>
                            <th>Mã hàng NCC</th>
                            <th>ĐVT Gốc</th>
                            <th>ĐVT</th>
                            <th>Số lượng hợp đồng</th>
                            <th>Số đã bán</th>
                            <th>Số lượng trả lại</th>
                            <th>Số lượng còn lại</th>
                            <th>% Hoàn thành</th>
                            <th>Mã ngành</th>
                            <th>Tên ngành</th>
                            <th>Nhân viên KD</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->DocNo }}</td>
                                <td>{{ $item->MaSo }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->DocDate)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->Date_SO)) }}</td>
                                <td>{{ $item->CustomerCode }}</td>
                                <td>{{ $item->CustomerName }}</td>
                                <td>{{ $item->Area }}</td>
                                <td>{{ $item->ItemCode }}</td>
                                <td>{{ $item->Description }}</td>
                                <td>{{ $item->ItemCode_NCC }}</td>
                                <td>{{ $item->Unit_Original }}</td>
                                <td>{{ $item->Unit }}</td>
                                <td>{{ number_format($item->Quantity, config('constants.number.zero'), ',', '.') }}</td>
                                <td>{{ number_format($item->QuantityXB, config('constants.number.zero'), ',', '.') }}</td>
                                <td>{{ number_format($item->QuantityTL, config('constants.number.zero'), ',', '.') }}</td>
                                <td>{{ number_format($item->QuantityCL, config('constants.number.zero'), ',', '.') }}</td>
                                <td>{{ number_format($item->QuantityP, config('constants.number.zero'), ',', '.') }}</td>
                                <td>{{ $item->ItemCatgCode }}</td>
                                <td>{{ $item->ItemCatgName }}</td>
                                <td>{{ $item->EmployeeName }}</td>
                                <td>{{ $item->Note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Số</th>
                            <th>Mã HĐ</th>
                            <th>Ngày tạo HĐ</th>
                            <th>Ngày ký HĐ</th>
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Vùng miền</th>
                            <th>Mã hàng</th>
                            <th>Tên hàng hóa dịch vụ</th>
                            <th>Mã hàng NCC</th>
                            <th>ĐVT Gốc</th>
                            <th>ĐVT</th>
                            <th>Số lượng hợp đồng</th>
                            <th>Số đã bán</th>
                            <th>Số lượng trả lại</th>
                            <th>Số lượng còn lại</th>
                            <th>% Hoàn thành</th>
                            <th>Mã ngành</th>
                            <th>Tên ngành</th>
                            <th>Nhân viên KD</th>
                            <th>Ghi chú</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/warehouse/list-quota-warning-report.js') }}"></script>
@endpush
