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

    <div class="modal fade" id="logoutModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

    <div class="modal fade" id="infoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <div class="info-item mb-3 d-flex align-items-center py-3 border-bottom">
                        <i class="fas fa-user text-primary"></i> 
                        <strong class="text-primary mx-2">Tên đăng nhập:</strong> {{Auth::user()->username}}
                    </div>
                    <div class="info-item mb-3 d-flex align-items-center py-3 border-bottom">
                        <i class="fas fa-id-badge text-primary"></i> 
                        <strong class="text-primary mx-2">Họ và tên:</strong> {{Auth::user()->name}}
                    </div>
                    <div class="info-item mb-3 d-flex align-items-center py-3 border-bottom">
                        <i class="fas fa-id-card text-primary"></i> 
                        <strong class="text-primary mx-2">Mã nhân viên:</strong> {{Auth::user()->EmployeeCode}}
                    </div>
                    <div class="info-item mb-3 d-flex align-items-center py-3 border-bottom">
                        <i class="fas fa-envelope text-primary"></i> 
                        <strong class="text-primary mx-2">Email:</strong> {{Auth::user()->email}}
                    </div>
                    {{-- <div class="info-item mb-3 d-flex align-items-center py-3 border-bottom">
                        <i class="fas fa-building text-primary"></i> 
                        <strong class="text-primary mx-2">Phòng ban:</strong> {{Auth::user()->department->name}}
                    </div> --}}
                    <div class="info-item mb-3 d-flex align-items-center py-3 border-bottom">
                        <i class="fas fa-briefcase text-primary"></i> 
                        <strong class="text-primary mx-2">Vai trò:</strong> {{Auth::user()->role->name}}
                    </div>
                    <div class="info-item mb-3 d-flex align-items-center py-3 border-bottom">
                        <i class="fas fa-inbox text-primary"></i> 
                        <strong class="text-primary mx-2">Khay:</strong> {{Auth::user()->company}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-sm" id="changePasswordModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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

    <div class="modal fade" id="timekeepingModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CHẤM CÔNG CHO NGÀY HÔM NAY</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-around">
                        <div class="text-center col-4">
                            <label for="hour" class="h3 text-primary font-weight-bold">GIỜ</label>
                            <div id="hour" class="bg-primary shadow-sm rounded-circle w-50 mx-auto">
                                <h4 class="text-white py-3 run-hour"></h4>
                            </div>
                        </div>
                        <div class="text-center col-4">
                            <label for="minute" class="h3 text-primary font-weight-bold">PHÚT</label>
                            <div id="minute" class="bg-primary shadow-sm rounded-circle w-50 mx-auto">
                                <h4 class="text-white py-3 run-minute"></h4>
                            </div>
                        </div>
                        <div class="text-center col-4">
                            <label for="second" class="h3 text-primary font-weight-bold">GIÂY</label>
                            <div id="second" class="bg-primary shadow-sm rounded-circle w-50 mx-auto">
                                <h4 class="text-white py-3 run-second"></h4>
                            </div>
                        </div>
                    </div>
                    <div class="bd-highlight mt-4 mx-4">
                        <div class="bd-highlight d-sm-flex align-items-center justify-content-center">
                            <h5 class="text-primary font-weight-bold pb-2 date-today"></h5>
                        </div>
                        <div class="bd-highlight d-sm-flex align-items-center justify-content-between">
                            <p class="font-weight-bold">
                                <b class="text-primary">Thời gian vào:</b>
                                <b id="timekeeping-in"></b>
                            </p>
                            <p class="font-weight-bold">
                                <b class="text-primary">Thời gian ra:</b>
                                <b id="timekeeping-out"></b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary shadow-sm" id="clock_in">Chấm công</button>
                </div>
            </div>
        </div>
    </div>
@endsection
