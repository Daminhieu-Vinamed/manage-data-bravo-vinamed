@extends('layout.master')
@section('title', 'Quản lý người dùng')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.responsive.min.css') }}" rel="stylesheet">
@endsection
@section('title-manage')
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ NGƯỜI DÙNG</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h6>
            <button class="btn btn-primary shadow-sm btn-circle" data-toggle="modal" data-target="#CreateUserModal" title="Tạo mới tài khoản"><i class="fas fa-plus-circle"></i></button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="users" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã nhân viên</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Phòng ban</th>
                            <th>Hành động</th>
                            <th>Khay</th>
                            <th>Ảnh</th>
                            <th>Giới tính</th>
                            <th>STT</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã nhân viên</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Phòng ban</th>
                            <th>Hành động</th>
                            <th>Khay</th>
                            <th>Ảnh</th>
                            <th>Giới tính</th>
                            <th>STT</th>
                        </tr>
                    </tfoot>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    @include('user.popup')
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/user/list.js') }}"></script>
    <script src="{{ asset('assets/js/user/create.js') }}"></script>
    <script src="{{ asset('assets/js/user/edit.js') }}"></script>
    <script src="{{ asset('assets/js/user/delete.js') }}"></script>
@endpush