@extends('layout.master')
@section('title', 'Đề nghị thanh toán')
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
            <button class="btn btn-primary shadow-sm btn-circle" data-toggle="modal" data-target="#userModal" title="Tạo mới tài khoản"><i class="fas fa-plus-circle"></i></button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="users" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                            <th>Công ty</th>
                            <th>Mã nhân viên Bravo</th>
                            <th>Ảnh</th>
                            <th>Giới tính</th>
                            <th>Bộ phận</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                            <th>Công ty</th>
                            <th>Mã nhân viên Bravo</th>
                            <th>Ảnh</th>
                            <th>Giới tính</th>
                            <th>Bộ phận</th>
                        </tr>
                    </tfoot>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo tài khoản</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="body_create">
                    <div class="form-group col-md-4">
                        <label for="username" class="form-label small">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="username" id="username">
                        <span class="text-danger small" id="username_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name" class="form-label small">Họ và tên</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <span class="text-danger small" id="name_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="form-label small">Email</label>
                        <input type="text" class="form-control" name="email" id="email">
                        <span class="text-danger small" id="email_error"></span>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="company" class="form-label small">Công ty</label>
                        <select class="form-control" name="company" id="company">
                            <option disabled selected>Chọn</option>
                            <option value="A11">A11</option>
                            <option value="A12">A12</option>
                            <option value="A14">A14</option>
                        </select>
                        <span class="text-danger small" id="company_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="role_code" class="form-label small">Vai trò</label>
                        <select class="form-control" name="role_code" id="role_code">
                            <option disabled selected>Chọn</option>
                            @foreach (config('constants.role') as $item)
                                @if ($item['code'] !== config('constants.role.super_admin')['code'])
                                    <option value="{{ $item['code'] }}">{{ $item['name'] }}</option>
                                @endif
                            @endforeach
                        </select>
                        <span class="text-danger small" id="role_code_error"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="department_code" class="form-label small">Phòng ban</label>
                        <select class="form-control" name="department_code" id="department_code">
                            <option disabled selected>Chọn</option>
                            @foreach (config('constants.department') as $item)
                                <option value="{{ $item['code'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger small" id="department_code_error"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="status_id" class="form-label small">Trạng thái</label>
                        <select name="status_id" class="form-control" id="status_id">
                            <option disabled selected>Chọn</option>
                            <option value="{{ config('constants.number.one') }}">Hoạt động</option>
                            <option value="{{ config('constants.number.two') }}">Dừng hoạt động</option>
                        </select>
                        <span class="text-danger small" id="status_id_error"></span>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="gender_id" class="form-label small">Giới tính</label>
                        <select name="gender_id" class="form-control" id="gender_id">
                            <option disabled selected>Chọn</option>
                            <option value="{{ config('constants.number.one') }}">Nam</option>
                            <option value="{{ config('constants.number.two') }}">Nữ</option>
                        </select>
                        <span class="text-danger small" id="gender_id_error"></span>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="nUserId" class="form-label small">ID user Bravo</label>
                        <input type="text" class="form-control" name="nUserId" id="nUserId">
                        <span class="text-danger small" id="nUserId_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="password" class="form-label small">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <span class="text-danger small" id="password_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="re_password" class="form-label small">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" name="re_password" id="re_password">
                        <span class="text-danger small" id="re_password_error"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="avatar" class="form-label small">Ảnh</label>
                        <input type="file" class="form-control" name="avatar" id="avatar">
                        <span class="text-danger small" id="avatar_error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary shadow-sm" id="create_user">Tạo mới</button>
            </div>
          </div>
        </div>
    </div>
@endsection
@push('js')
     <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ asset('assets/vendor/datatables/dataTables.responsive.min.js') }}"></script>
     <script src="{{ asset('assets/js/user/list.js') }}"></script>
     <script src="{{ asset('assets/js/user/create.js') }}"></script>
     <script src="{{ asset('assets/js/user/delete.js') }}"></script>
@endpush