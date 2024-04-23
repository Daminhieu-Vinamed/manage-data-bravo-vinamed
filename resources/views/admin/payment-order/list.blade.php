@extends('layout.master')
@section('title', 'Đề nghị thanh toán')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.responsive.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách đề nghị thanh toán</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã công ty</th>
                            <th>Số chứng từ</th>
                            <th>Người nhận</th>
                            <th>Người đề nghị</th>
                            <th>Tiền</th>
                            <th>Đơn vị</th>
                            <th>Hành động</th>
                            <th>Ngày</th>
                            <th>Tình trạng</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã công ty</th>
                            <th>Số chứng từ</th>
                            <th>Người nhận</th>
                            <th>Người đề nghị</th>
                            <th>Tiền</th>
                            <th>Đơn vị</th>
                            <th>Hành động</th>
                            <th>Ngày</th>
                            <th>Tình trạng</th>
                        </tr>
                    </tfoot>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
     <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/dataTables.responsive.min.js') }}"></script>
     <script src="{{ asset('assets/js/payment-order/list.js') }}"></script>
     <script src="{{ asset('assets/js/payment-order/approve.js') }}"></script>
     <script src="{{ asset('assets/js/payment-order/cancel.js') }}"></script>
@endpush