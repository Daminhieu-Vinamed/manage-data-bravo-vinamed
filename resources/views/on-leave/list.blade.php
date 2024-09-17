@extends('layout.master')
@section('title', 'Danh sách nghỉ phép')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.responsive.min.css') }}" rel="stylesheet">
@endsection
@section('title-manage')
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">DANH SÁCH NGHỈ PHÉP</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách nghỉ phép</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="on_leave" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Khay</th>
                            <th>Mã nhân viên</th>
                            <th>Tên nhân viên</th>
                            <th>Bộ phận</th>
                            <th>Loại nghỉ phép</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Lý do</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Khay</th>
                            <th>Mã nhân viên</th>
                            <th>Tên nhân viên</th>
                            <th>Bộ phận</th>
                            <th>Loại nghỉ phép</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Lý do</th>
                            <th>Hành động</th>
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
     <script src="{{ asset('assets/js/on-leave/list.js') }}"></script>
@endpush