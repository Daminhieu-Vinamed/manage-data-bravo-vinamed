@extends('layout.master')
@section('title', 'Tạo mới')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
@endsection
@section('title-manage')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">QUẢN LÝ NGƯỜI DÙNG</h1>
    </div>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa người dùng</h6>
        </div>
        <div class="card-body">
            @if (empty($user))
                <div class="py-3 row justify-content-center">
                    <i class="text-center text-danger fas fa-user-alt-slash fa-7x"></i>
                </div>
            @else
                <div class="row" id="body_edit">
                    <div class="form-group col-md-4">
                        <label for="username" class="form-label small">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" value="{{$user->username}}">
                        <span class="text-danger small" id="username_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name" class="form-label small">Họ và tên</label>
                        <input type="text" class="form-control" id="name" value="{{$user->name}}">
                        <span class="text-danger small" id="name_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="form-label small">Email</label>
                        <input type="text" class="form-control" id="email" value="{{$user->email}}">
                        <span class="text-danger small" id="email_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="EmployeeCode" class="form-label small">Mã nhân viên Bravo</label>
                        <input type="text" class="form-control" id="EmployeeCode" value="{{$user->EmployeeCode}}">
                        <span class="text-danger small" id="EmployeeCode_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="company" class="form-label small">Khay</label>
                        <select class="form-control-select2" id="company">
                            <option selected value="">Chọn công ty</option>
                            @foreach (config('constants.company') as $company)
                                <option value="{{$company}}" {{ $user->company === $company ? 'selected' : '' }}>{{$company}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger small" id="company_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="parent_user_id" class="form-label small">Quản lý</label>
                        <select class="form-control-select2" id="parent_user_id">
                            <option selected value="">Chọn quản lý</option>
                            @foreach ($parents as $parent)
                                <option value="{{$parent->id}}" {{ $user->parent_user_id == $parent->id ? 'selected' : '' }}>{{$parent->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger small" id="parent_user_id_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="role_id" class="form-label small">Vai trò</label>
                        <select class="form-control-select2" id="role_id">
                            <option selected>Chọn vai trò</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}" {{$user->role_id === $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger small" id="role_id_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status_id" class="form-label small">Trạng thái</label>
                        <select class="form-control-select2" id="status_id">
                            <option selected>Chọn trạng thái</option>
                            <option value="{{ config('constants.number.one') }}" {{$user->status_id === config('constants.number.one') ? 'selected' : '' }}>Hoạt động</option>
                            <option value="{{ config('constants.number.two') }}" {{$user->status_id === config('constants.number.two') ? 'selected' : '' }}>Dừng hoạt động</option>
                        </select>
                        <span class="text-danger small" id="status_id_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gender_id" class="form-label small">Giới tính</label>
                        <select class="form-control-select2" id="gender_id">
                            <option selected>Chọn giới tính</option>
                            <option value="{{ config('constants.number.one') }}" {{$user->gender_id === config('constants.number.one') ? 'selected' : '' }}>Nam</option>
                            <option value="{{ config('constants.number.two') }}" {{$user->gender_id === config('constants.number.two') ? 'selected' : '' }}>Nữ</option>
                        </select>
                        <span class="text-danger small" id="gender_id_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="is_warehouse_active" class="form-label small">Kho</label>
                        <select class="form-control-select2" id="is_warehouse_active">
                            <option selected value="">Hiển thị kho</option>
                            <option value="{{ config('constants.number.one') }}" {{$user->is_warehouse_active === config('constants.number.one') ? 'selected' : '' }}>Có</option>
                            <option value="{{ config('constants.number.two') }}" {{$user->is_warehouse_active === config('constants.number.two') ? 'selected' : '' }}>không</option>
                        </select>
                        <span class="text-danger small" id="is_warehouse_active_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="birthday" class="form-label small">Sinh nhật</label>
                        <input type="date" class="form-control" id="birthday" value="{{ date('Y-m-d', strtotime($user->birthday)) }}">
                        <span class="text-danger small" id="birthday_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="avatar" class="form-label small">Ảnh đại diện</label>
                        <input type="file" class="form-control" id="avatar">
                        <input type="hidden" id="old_avatar" value="{{$user->avatar}}">
                        <span class="text-danger small" id="avatar_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <button type="button" id="delete_avatar" class="btn btn-danger btn-circle position-absolute m-3" style="z-index: 1"><i class="fas fa-trash-alt"></i></button>
                        <img id="flex_avatar" src="{{ asset($user->avatar) }}" class="img-thumbnail position-relative" alt="Đây không phải là file ảnh"/>
                    </div>
                </div>
                <div class="py-3 row justify-content-center">
                    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2" id="update_user">CẬP NHẬT</button>
                    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-2" id="change-password">ĐỔI MẬT KHẨU</button>
                </div> 
            @endif
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/user/edit.js') }}"></script>
@endpush
