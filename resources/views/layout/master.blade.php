@extends('layout.base')
@section('screen')
    <div id="wrapper">
        @include('layout.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layout.header')
                <div class="container-fluid">
                    @yield('title-manage')
                    @yield('content')
                </div>
            </div>
            @include('layout.footer')
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng đăng xuất?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn sẵn sàng kết thúc phiên đăng nhập hiện tại của mình.</div>
                <div class="modal-footer">
                    <a class="btn btn-primary shadow-sm" href="{{ route('logout') }}">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">THÔNG TIN CÁ NHÂN</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="bd-highlight d-sm-flex align-items-center justify-content-between">
                        <p class="font-weight-bold">
                            <b class="text-primary">Tên đăng nhập:</b>
                            <b id="username">{{Auth::user()->username}}</b>
                        </p>
                        <p class="font-weight-bold">
                            <b class="text-primary">Họ và tên:</b>
                            <b id="name">{{Auth::user()->name}}</b>
                        </p>
                    </div>
                    <div class="bd-highlight d-sm-flex align-items-center justify-content-between">
                        <p class="font-weight-bold">
                            <b class="text-primary">Mã nhân viên:</b>
                            <b id="EmployeeCode">{{Auth::user()->EmployeeCode}}</b>
                        </p>
                        <p class="font-weight-bold">
                            <b class="text-primary">Email:</b>
                            <b id="email">{{Auth::user()->email}}</b>
                        </p>
                    </div>
                    <div class="bd-highlight d-sm-flex align-items-center justify-content-between">
                        <p class="font-weight-bold">
                            <b class="text-primary">Phòng:</b>
                            <b id="department">{{Auth::user()->department->name}}</b>
                        </p>
                        <p class="font-weight-bold">
                            <b class="text-primary">Vai trò:</b>
                            <b id="name">{{Auth::user()->role->name}}</b>
                        </p>
                        <p class="font-weight-bold">
                            <b class="text-primary">Khay:</b>
                            <b id="company">{{Auth::user()->company}}</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-sm" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">THAY ĐỔI MẬT KHẨU</h5>
                <button class="close" type="button" id="close-change-password" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group col-md-12">
                        <label for="old_password" class="form-label small">Mật khẩu cũ</label>
                        <input type="password" class="form-control" id="old_password">
                        <span id="validate-old-password-error" class="text-danger small"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="new_password" class="form-label small">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="new_password">
                        <span id="validate-new-password-error" class="text-danger small"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="re_new_password" class="form-label small">Nhập lại mật khẩu mới</label>
                        <input type="password" class="form-control" id="re_new_password">
                        <span id="validate-re-new-password-error" class="text-danger small"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary shadow-sm" id="change_password">Đổi mật khẩu</button>
            </div>
          </div>
        </div>
      </div>
@endsection
