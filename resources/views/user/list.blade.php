@extends('layout.master')
@section('title', 'Quản lý người dùng')
@section('css')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.responsive.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
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
            <div>
                <button class="btn btn-primary shadow-sm btn-circle" data-toggle="modal" data-target="#CreateUserModal" title="Tạo mới tài khoản"><i class="fas fa-user-plus"></i></button>
                <a href="{{ route('user.deleted') }}" class="btn btn-danger shadow-sm btn-circle" title="Tài khoản đã xóa"><i class="fas fa-trash-alt"></i></a>
            </div>
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
                            <th>Quản lý</th>
                            <th>Khay</th>
                            <th>Ảnh</th>
                            <th>Giới tính</th>
                            <th>STT</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã nhân viên</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Quản lý</th>
                            <th>Khay</th>
                            <th>Ảnh</th>
                            <th>Giới tính</th>
                            <th>STT</th>
                            <th>Hành động</th>
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
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/user/list.js') }}"></script>
    <script src="{{ asset('assets/js/user/create.js') }}"></script>
    <script src="{{ asset('assets/js/user/delete.js') }}"></script>
@endpush