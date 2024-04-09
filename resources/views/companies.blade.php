@extends('layout.master')
@section('title', 'Payment order')
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
                            <th>Ngày</th>
                            <th>Số chứng từ</th>
                            <th>Người nhận</th>
                            <th>Tiền</th>
                            <th>Người đề nghị</th>
                            <th>Hành động</th>
                            <th>Tình trạng thanh toán</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã công ty</th>
                            <th>Ngày</th>
                            <th>Số chứng từ</th>
                            <th>Người nhận</th>
                            <th>Tiền</th>
                            <th>Người đề nghị</th>
                            <th>Hành động</th>
                            <th>Tình trạng thanh toán</th>
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
     <script src="{{ asset('assets/js/companies.js') }}"></script>
@endpush