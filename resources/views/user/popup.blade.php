<div class="modal fade bd-example-modal-lg" id="CreateUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <label for="username" class="form-label small">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username">
                    <span class="text-danger small" id="username_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="name" class="form-label small">Họ và tên</label>
                    <input type="text" class="form-control" id="name">
                    <span class="text-danger small" id="name_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="email" class="form-label small">Email</label>
                    <input type="text" class="form-control" id="email">
                    <span class="text-danger small" id="email_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="company" class="form-label small">Khay</label>
                    <select class="form-control-select2" id="company">
                        <option selected value="">Chọn khay</option>
                        @foreach (config('constants.company') as $company)
                            <option value="{{$company}}">{{$company}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger small" id="company_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="role_id" class="form-label small">Vai trò</label>
                    <select class="form-control-select2" id="role_id">
                        <option selected value="">Chọn vai trò</option>
                        @foreach ($roles as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger small" id="role_id_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="parent_user_id" class="form-label small">Quản lý</label>
                    <select class="form-control-select2" id="parent_user_id">
                        <option selected value="">Chọn quản lý</option>
                        @foreach ($parents as $parent)
                            <option value="{{$parent->id}}">{{$parent->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger small" id="parent_user_id_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="status_id" class="form-label small">Trạng thái</label>
                    <select class="form-control-select2" id="status_id">
                        <option selected value="">Chọn trạng thái</option>
                        <option value="{{ config('constants.number.one') }}">Hoạt động</option>
                        <option value="{{ config('constants.number.two') }}">Dừng hoạt động</option>
                    </select>
                    <span class="text-danger small" id="status_id_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="gender_id" class="form-label small">Giới tính</label>
                    <select class="form-control-select2" id="gender_id">
                        <option selected value="">Chọn giới tính</option>
                        <option value="{{ config('constants.number.one') }}">Nam</option>
                        <option value="{{ config('constants.number.two') }}">Nữ</option>
                    </select>
                    <span class="text-danger small" id="gender_id_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="is_warehouse_active" class="form-label small">Kho</label>
                    <select class="form-control-select2" id="is_warehouse_active">
                        <option selected value="">Hiển thị kho</option>
                        <option value="{{ config('constants.number.one') }}">Có</option>
                        <option value="{{ config('constants.number.two') }}">không</option>
                    </select>
                    <span class="text-danger small" id="is_warehouse_active_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="EmployeeCode" class="form-label small">Mã nhân viên Bravo</label>
                    <input type="text" class="form-control" id="EmployeeCode">
                    <span class="text-danger small" id="EmployeeCode_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="password" class="form-label small">Mật khẩu</label>
                    <input type="password" class="form-control" id="password">
                    <span class="text-danger small" id="password_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="re_password" class="form-label small">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" id="re_password">
                    <span class="text-danger small" id="re_password_error"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="avatar" class="form-label small">Ảnh</label>
                    <input type="file" class="form-control" id="avatar">
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