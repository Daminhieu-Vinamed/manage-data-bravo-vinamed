@extends('layout.master')
@section('title', 'Tạo đề nghị xuất kho')
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
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Điều kiện đề nghị xuất kho</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="startDate" class="form-label small">Khách hàng</label>
                            <input type="text" class="form-control-select2" id="customer" name="customer">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="endDate" class="form-label small">Mục đích sử dụng</label>
                            <input type="text" class="form-control-select2" id="customer" name="customer">
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="search_product">Tìm sản phẩm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm đề nghị xuất kho</h6>
                </div>
                <div class="card-body" id="list_product">
                    <table class="table table-bordered" id="table_products" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Chọn sản phẩm</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn vị tính</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/warehouse/recommend-warehouse-release/create.js') }}"></script>
@endpush
