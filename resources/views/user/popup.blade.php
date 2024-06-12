<div class="modal fade bd-example-modal-lg" id="CreateUserModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">TẠO TÀI KHOẢN</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row" id="body_create">
                <div class="form-group col-md-4">
                    <label for="username_c" class="form-label small">Tên đăng nhập</label>
                    <input type="text" class="form-control" name="username_c" id="username_c">
                    <span class="text-danger small" id="username_error_c"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="name_c" class="form-label small">Họ và tên</label>
                    <input type="text" class="form-control" name="name_c" id="name_c">
                    <span class="text-danger small" id="name_error_c"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="email_c" class="form-label small">Email</label>
                    <input type="text" class="form-control" name="email_c" id="email_c">
                    <span class="text-danger small" id="email_error_c"></span>
                </div>
                <div class="form-group col-md-2">
                    <label for="company_c" class="form-label small">Công ty</label>
                    <select class="form-control" name="company_c" id="company_c">
                        <option disabled selected>Chọn</option>
                        @foreach (config('constants.company') as $company)
                            <option value="{{$company}}">{{$company}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger small" id="company_error_c"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="role_code_c" class="form-label small">Vai trò</label>
                    <select class="form-control" name="role_code_c" id="role_code_c">
                        <option disabled selected>Chọn</option>
                        @foreach (config('constants.role') as $item)
                            @if ($item['code'] !== config('constants.role.super_admin')['code'])
                                <option value="{{ $item['code'] }}">{{ $item['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="text-danger small" id="role_code_error_c"></span>
                </div>
                <div class="form-group col-md-3">
                    <label for="department_code_c" class="form-label small">Phòng ban</label>
                    <select class="form-control" name="department_code_c" id="department_code_c">
                        <option disabled selected>Chọn</option>
                        @foreach (config('constants.department') as $item)
                            <option value="{{ $item['code'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger small" id="department_code_error_c"></span>
                </div>
                <div class="form-group col-md-3">
                    <label for="status_id_c" class="form-label small">Trạng thái</label>
                    <select name="status_id_c" class="form-control" id="status_id_c">
                        <option disabled selected>Chọn</option>
                        <option value="{{ config('constants.number.one') }}">Hoạt động</option>
                        <option value="{{ config('constants.number.two') }}">Dừng hoạt động</option>
                    </select>
                    <span class="text-danger small" id="status_id_error_c"></span>
                </div>
                <div class="form-group col-md-2">
                    <label for="gender_id_c" class="form-label small">Giới tính</label>
                    <select name="gender_id_c" class="form-control" id="gender_id_c">
                        <option disabled selected>Chọn</option>
                        <option value="{{ config('constants.number.one') }}">Nam</option>
                        <option value="{{ config('constants.number.two') }}">Nữ</option>
                    </select>
                    <span class="text-danger small" id="gender_id_error_c"></span>
                </div>
                <div class="form-group col-md-2">
                    <label for="EmployeeCode_c" class="form-label small">Mã nhân viên Bravo</label>
                    <input type="text" class="form-control" name="EmployeeCode_c" id="EmployeeCode_c">
                    <span class="text-danger small" id="EmployeeCode_error_c"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="password_c" class="form-label small">Mật khẩu</label>
                    <input type="password" class="form-control" name="password_c" id="password_c">
                    <span class="text-danger small" id="password_error_c"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="re_password_c" class="form-label small">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" name="re_password_c" id="re_password_c">
                    <span class="text-danger small" id="re_password_error_c"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="avatar_c" class="form-label small">Ảnh</label>
                    <input type="file" class="form-control" name="avatar_c" id="avatar_c">
                    <span class="text-danger small" id="avatar_error_c"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary shadow-sm" id="create_user">Tạo mới</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="EditUserModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">CHỈNH SỬA TÀI KHOẢN</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row" id="body_edit">
                <div class="form-group col-md-4">
                    <label for="username_e" class="form-label small">Tên đăng nhập</label>
                    <input type="text" class="form-control" name="username_e" id="username_e">
                    <span class="text-danger small" id="username_error_e"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="name_e" class="form-label small">Họ và tên</label>
                    <input type="text" class="form-control" name="name_e" id="name_e">
                    <span class="text-danger small" id="name_error_e"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="email_e" class="form-label small">Email</label>
                    <input type="text" class="form-control" name="email_e" id="email_e">
                    <span class="text-danger small" id="email_error_e"></span>
                </div>
                <div class="form-group col-md-2">
                    <label for="company_e" class="form-label small">Công ty</label>
                    <select class="form-control" name="company_e" id="company_e">
                        <option disabled selected>Chọn</option>
                        <option value="A11">A11</option>
                        <option value="A12">A12</option>
                        <option value="A14">A14</option>
                    </select>
                    <span class="text-danger small" id="company_error_e"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="role_code_e" class="form-label small">Vai trò</label>
                    <select class="form-control" name="role_code_e" id="role_code_e">
                        <option disabled selected>Chọn</option>
                        @foreach (config('constants.role') as $item)
                            @if ($item['code'] !== config('constants.role.super_admin')['code'])
                                <option value="{{ $item['code'] }}">{{ $item['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                    <span class="text-danger small" id="role_code_error_e"></span>
                </div>
                <div class="form-group col-md-3">
                    <label for="department_code_e" class="form-label small">Phòng ban</label>
                    <select class="form-control" name="department_code_e" id="department_code_e">
                        <option disabled selected>Chọn</option>
                        @foreach (config('constants.department') as $item)
                            <option value="{{ $item['code'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger small" id="department_code_error_e"></span>
                </div>
                <div class="form-group col-md-3">
                    <label for="status_id_e" class="form-label small">Trạng thái</label>
                    <select name="status_id_e" class="form-control" id="status_id_e">
                        <option disabled selected>Chọn</option>
                        <option value="{{ config('constants.number.one') }}">Hoạt động</option>
                        <option value="{{ config('constants.number.two') }}">Dừng hoạt động</option>
                    </select>
                    <span class="text-danger small" id="status_id_error_e"></span>
                </div>
                <div class="form-group col-md-2">
                    <label for="gender_id_e" class="form-label small">Giới tính</label>
                    <select name="gender_id_e" class="form-control" id="gender_id_e">
                        <option disabled selected>Chọn</option>
                        <option value="{{ config('constants.number.one') }}">Nam</option>
                        <option value="{{ config('constants.number.two') }}">Nữ</option>
                    </select>
                    <span class="text-danger small" id="gender_id_error_e"></span>
                </div>
                <div class="form-group col-md-2">
                    <label for="EmployeeCode_e" class="form-label small">ID user Bravo</label>
                    <input type="text" class="form-control" name="EmployeeCode_e" id="EmployeeCode_e">
                    <span class="text-danger small" id="EmployeeCode_error_e"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="password_e" class="form-label small">Mật khẩu</label>
                    <input type="password" class="form-control" name="password_e" id="password_e">
                    <span class="text-danger small" id="password_error_e"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="re_password_e" class="form-label small">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" name="re_password_e" id="re_password_e">
                    <span class="text-danger small" id="re_password_error_e"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="avatar_e" class="form-label small">Ảnh</label>
                    <input type="file" class="form-control" name="avatar_e" id="avatar_e">
                    <span class="text-danger small" id="avatar_error_e"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary shadow-sm" id="update_user">Cập nhật</button>
        </div>
      </div>
    </div>
  </div>