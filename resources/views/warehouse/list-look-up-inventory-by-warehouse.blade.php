@extends('layout.master')
@section('title', 'Danh sách tồn theo kho')
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
            <h6 class="m-0 font-weight-bold text-primary">Danh sách tồn theo kho</h6>
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
                            <th>Mã mặt hàng</th>
                            <th>Mã vật tư NCC</th>
                            <th>Tên mặt hàng</th>
                            <th>Mã kho</th>
                            <th>Số lô</th>
                            <th>Hạn sử dụng</th>
                            <th>Tồn kho</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->ItemCode }}</td>
                                <td>{{ $item->ItemCode_NCC }}</td>
                                <td>{{ $item->ItemName }}</td>
                                <td>{{ $item->WarehouseCode }}</td>
                                <td>{{ $item->So_Lo }}</td>
                                <td>{{ $item->ExpiryDate == config('constants.value.null') ? config('constants.value.empty') : date('d-m-Y', strtotime($item->ExpiryDate)) }}
                                </td>
                                <td>{{ number_format($item->CloseInventory, config('constants.number.two'), '.', ',') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Mã mặt hàng</th>
                            <th>Mã vật tư NCC</th>
                            <th>Tên mặt hàng</th>
                            <th>Mã kho</th>
                            <th>Số lô</th>
                            <th>Hạn sử dụng</th>
                            <th>Tồn kho</th>
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
    <script src="{{ asset('assets/js/warehouse/list-look-up-inventory-by-warehouse.js') }}"></script>
@endpush
