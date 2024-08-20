@extends('layout.master')
@section('title', 'Tạo mới')
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
                        <label for="company" class="form-label small">Công ty</label>
                        <select class="custom-select" id="company">
                            <option disabled selected>Chọn công ty</option>
                            @foreach (config('constants.company') as $company)
                                <option value="{{$company}}" {{ $user->company === $company ? 'selected' : '' }}>{{$company}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger small" id="company_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="department_code" class="form-label small">Phòng ban</label>
                        <input list="list_department_code" class="form-control" id="department_code" data-value="{{$user->department_code}}">
                        <datalist id="list_department_code">
                            @foreach ($departments as $item)
                                @if ($item->code !== 'ADMIN')
                                    <option data-value="{{ $item->code }}" value="{{ $item->name }}"></option>
                                @endif
                            @endforeach
                        </datalist>
                        <span class="text-danger small" id="department_code_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="role_id" class="form-label small">Vai trò</label>
                        <select class="custom-select" id="role_id">
                            <option disabled selected>Chọn vai trò</option>
                            @foreach ($roles as $item)
                                @if ($item->id !== config('constants.number.one'))
                                    <option value="{{ $item->id }}" {{$user->role_id === $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <span class="text-danger small" id="role_id_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status_id" class="form-label small">Trạng thái</label>
                        <select class="custom-select" id="status_id">
                            <option disabled selected>Chọn trạng thái</option>
                            <option value="{{ config('constants.number.one') }}" {{$user->status_id === config('constants.number.one') ? 'selected' : '' }}>Hoạt động</option>
                            <option value="{{ config('constants.number.two') }}" {{$user->status_id === config('constants.number.two') ? 'selected' : '' }}>Dừng hoạt động</option>
                        </select>
                        <span class="text-danger small" id="status_id_error"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gender_id" class="form-label small">Giới tính</label>
                        <select class="custom-select" id="gender_id">
                            <option disabled selected>Chọn giới tính</option>
                            <option value="{{ config('constants.number.one') }}" {{$user->gender_id === config('constants.number.one') ? 'selected' : '' }}>Nam</option>
                            <option value="{{ config('constants.number.two') }}" {{$user->gender_id === config('constants.number.two') ? 'selected' : '' }}>Nữ</option>
                        </select>
                        <span class="text-danger small" id="gender_id_error"></span>
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
    <script src="{{ asset('assets/js/user/edit.js') }}"></script>
@endpush
